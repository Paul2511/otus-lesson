<template>
    <div>
        <div id="specializations-list">
            <div class="vx-card p-6">
                <vs-table
                        v-if="!isLoading"
                        :data="items"
                        :noDataText="$t('noData')"
                        sst
                        @sort="handleSort"
                >
                    <template slot="header">
                        <h3>{{ $t('Specializations') }}</h3>

                        <vs-button
                                color="primary"
                                style="margin-left: auto"
                                size="small"
                                class="mb-2"
                                icon-pack="feather"
                                icon="icon-plus-circle"
                                @click="add"
                        >
                            {{ $t('buttons.add') }}
                        </vs-button>

                        <vx-input-group class="mb-2 input-group-search">
                            <vs-input :placeholder="$t('Search')+'...'" @keyup.enter="handleSearch" v-model="search"/>

                            <template slot="append">
                                <div class="append-text btn-addon">
                                    <vs-button color="primary" size="small" @click="handleSearch">{{ $t('buttons.find') }}</vs-button>
                                </div>
                            </template>
                        </vx-input-group>

                    </template>
                    <template slot="thead">
                        <vs-th :key="th.key" v-for="th in tableColumns" :sort-key="th.sort?th.key:null">{{ th.label }}</vs-th>
                        <vs-th class="action-column">{{ $t('Actions') }}</vs-th>
                    </template>
                    <template slot-scope="{data}">
                        <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                            <vs-td :data="data[indextr].id">
                                {{ data[indextr].id }}
                            </vs-td>
                            <vs-td :data="data[indextr].slug">
                                {{ data[indextr].slug }}
                            </vs-td>
                            <vs-td :key="locale" v-for="locale in locales" :data="data[indextr]['locale_'+locale] || ''">
                                {{ data[indextr]['locale_'+locale] || '' }}
                            </vs-td>
                            <vs-td class="action-column">
                                <vs-dropdown vs-trigger-click>
                                    <vs-button radius color="primary" type="flat" icon-pack="feather" icon="icon-more-vertical"></vs-button>
                                    <vs-dropdown-menu>
                                        <vs-dropdown-item @click="edit(data[indextr])">
                                            {{ $t('buttons.edit') }}
                                        </vs-dropdown-item>
                                        <vs-dropdown-item :disabled="!data[indextr].canDelete" @click="del(data[indextr])">
                                            {{ $t('buttons.delete') }}
                                        </vs-dropdown-item>
                                    </vs-dropdown-menu>
                                </vs-dropdown>
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
                <div v-if="totalItems > maxItems" class="mt-5">
                    <vs-pagination :total="Math.round(totalItems/maxItems)" v-model="currentPage"></vs-pagination>
                </div>
            </div>
        </div>

        <specialization-modal v-if="modalOpened" :item="modalItem" @close="modalClose" @changed="itemChanged"></specialization-modal>
    </div>

</template>


<script>
    import {BSpinner, BRow, BCol, BButton, BFormInput} from 'bootstrap-vue'
    import specializationModal from '@/modals/specialization-modal/specialization-modal.vue'
    export default {
        components: {
            specializationModal,
            BSpinner, BRow, BCol, BButton, BFormInput
        },
        data() {
            return {
                isLoading: true,
                items: undefined,
                tableColumns: undefined,
                sort: 'id',
                direction: 'asc',
                maxItems: 10,
                totalItems: 0,
                page: 1,
                currentPage: 1,
                search: '',
                modalOpened: false,
                modalItem: {}
            }
        },
        mounted() {
            this.getItems();
        },
        methods: {
            getItems() {
                this.$vs.loading({
                    type: 'point'
                });
                let params = {};
                if (this.sort) {
                    params.sort = this.sort;
                }
                if (this.direction) {
                    params.direction = this.direction;
                }
                if (this.page) {
                    params.page = this.page;
                }
                if (this.search) {
                    params.query = this.search;
                }

                this.$store.dispatch('getSpecializations', params)
                    .then(res => {
                        this.items = res.data.data;
                        this.tableColumns = res.data.fields;
                        if (!!res.data.meta) {
                            this.maxItems = res.data.meta.per_page;
                            this.totalItems = res.data.meta.total;
                        }
                    })
                    .catch(err => {
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger',
                            iconPack: 'feather',
                            icon: 'icon-alert-circle'
                        })
                    })
                    .finally(() => {
                        this.$vs.loading.close();
                        this.isLoading = false;
                    });
            },
            handleSort(key, active) {
                if (key) {
                    this.sort = key;
                    this.direction = active;
                    this.getItems();
                }
            },
            handleSearch() {
                this.getItems();
            },
            add() {
                let translates = [];

                if (this.locales.length) {
                    this.locales.forEach((locale) => {
                        translates.push({
                            type: 'specialization',
                            locale: locale,
                            value: ''
                        });
                    });
                }
                this.modalItem = {
                    slug: '',
                    translates: translates
                };
                this.modalOpened = true;
            },
            del(item) {
                let _this = this;

                this.$vs.dialog({
                    type: 'confirm',
                    color:'danger',
                    title: this.$t('main.confirmDelete'),
                    text: this.$t('specialization.confirmDelete', {slug: item.slug}),
                    acceptText: this.$t('buttons.delete'),
                    cancelText: this.$t('buttons.cancel'),
                    buttonsHidden: true,
                    accept:function () {
                        _this.acceptDel(item);
                    }
                })
            },
            acceptDel(item) {
                this.$vs.loading();
                this.$store.dispatch('deleteSpecialization', item.id)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.getItems();
                    })
                    .catch(err => {
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            },
            edit(item) {
                this.modalItem = item;
                this.modalOpened = true;
            },
            modalClose() {
                this.modalOpened = false;
                this.modalItem = undefined;
            },
            itemChanged() {
                this.modalOpened = false;
                this.modalItem = undefined;
                this.getItems();
            },
        },
        computed: {
            params() {
                return this.$store.state.appParams;
            },
            locales() {
                return this.params.locales;
            },
            windowWidth() {
                return this.$store.getters.windowBreakPoint
            }
        },
        watch: {
            currentPage(val) {
                this.page = val;
                this.getItems();
            }
        }
    }
</script>


<style lang="scss" scoped>
    .input-group-search {
        margin-left: auto;
    }
    .action-column {
        text-align: center;
        width: 1%;
    }
    .vs-dropdown--item {
        white-space: nowrap;
    }
</style>