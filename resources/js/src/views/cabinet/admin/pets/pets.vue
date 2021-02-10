<template>
    <div>
        <div id="pet-list">
            <div class="vx-card p-6">
                <vs-table
                        v-if="!isLoading"
                        :data="items"
                        :noDataText="$t('noData')"
                        sst
                        @sort="handleSort"
                >
                    <template slot="header">

                        <div class="flex flex-col flex-grow-1">
                            <div class="flex align-content-center">
                                <h3>{{ $t('pet.petList') }}</h3>
                                <vs-button v-if="0"
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
                            </div>
                            <div class="flex align-content-center" style="margin-top: 10px; margin-bottom: 10px">
                                <div class="flex align-items-center">
                                    <div>
                                        <vs-select v-model="filterType" val-icon-danger="icon-x" val-icon-pack="feather">
                                            <vs-select-item
                                                    size="small"
                                                    :text="'- ' + $t('pet.type') + ' -'"
                                                    class="w-full"/>
                                            <vs-select-item
                                                    size="small"
                                                    :key="petType.id"
                                                    :value="petType.id"
                                                    :text="petType.title"
                                                    v-for="petType in petTypes"
                                                    class="w-full"
                                            />
                                        </vs-select>
                                    </div>

                                    <div class="ml-3">
                                        <vs-select v-model="filterSex" val-icon-danger="icon-x" val-icon-pack="feather">
                                            <vs-select-item
                                                    size="small"
                                                    :text="'- ' + $t('pet.sex') + ' -'"
                                                    class="w-full"/>
                                            <vs-select-item
                                                    size="small"
                                                    :key="index"
                                                    :value="index"
                                                    :text="item"
                                                    v-for="(item,index) in petSexes"
                                                    class="w-full"
                                            />
                                        </vs-select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                            <vs-td :data="data[indextr].name">
                                {{ data[indextr].name }}
                            </vs-td>
                            <vs-td :data="data[indextr].clientName">
                                {{ data[indextr].clientName }}
                            </vs-td>
                            <vs-td :data="data[indextr].petTypeTitle">
                                {{ data[indextr].petTypeTitle }}
                            </vs-td>
                            <vs-td :data="data[indextr].currentSex.label">
                                {{ data[indextr].currentSex.label }}
                            </vs-td>
                            <vs-td :data="data[indextr].created_at">
                                {{ data[indextr].created_at }}
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
    </div>

</template>


<script>
    import {BSpinner, BRow, BCol, BButton, BFormInput} from 'bootstrap-vue'
    export default {
        components: {
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
                filter: {},
                filterType: null,
                filterSex: null
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

                if (this.filter) {
                    let hasFilter = false;
                    for (let key in this.filter) {
                        if (hasOwnProperty.call(this.filter, key)) {
                            hasFilter = true;
                        }
                    }
                    if (hasFilter) {
                        params.filter = this.filter;
                    }
                }

                this.$store.dispatch('getPetsList', params)
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

                //this.modalOpened = true;
            },
            del(item) {
                let _this = this;
                this.$vs.dialog({
                    type: 'confirm',
                    color:'danger',
                    title: this.$t('main.confirmDelete'),
                    text: this.$t('pet.confirmDelete', {name: item.name}),
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
                this.$store.dispatch('deletePet', item.id)
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
                this.$store.dispatch('openPetModal', {petId: item.id, isEdit: true, modalAction: 'changed'});
            }
        },

        computed: {
            params() {
                return this.$store.state.appParams;
            },
            petTypes() {
                return this.params.petTypes;
            },
            petSexes() {
                return this.params.petSexes;
            },
            windowWidth() {
                return this.$store.getters.windowBreakPoint
            },
            changedPet() {
                return this.$store.getters.changedPet
            }

        },
        watch: {
            currentPage(val) {
                this.page = val;
                this.getItems();
            },
            filterType(v) {
                if (v) {
                    this.filter.pet_type_id = v;
                } else {
                    delete this.filter.pet_type_id;
                }
                this.getItems();
            },
            filterSex(v) {
                if (v) {
                    this.filter.sex = v;
                } else {
                    delete this.filter.sex;
                }

                this.getItems();
            },
            changedPet(v) {
                if (v===true) {
                    this.getItems();
                    this.$store.commit('CHANGED_PET', false);
                }
            }
        }
    }
</script>

<style lang="scss">
    .header-table {
        margin-bottom: 10px;
    }

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