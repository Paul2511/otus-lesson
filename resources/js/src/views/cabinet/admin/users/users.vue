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
                                <h3>{{ $t('user.userList') }}</h3>
                                <vs-button
                                   color="primary"
                                   style="margin-left: auto"
                                   size="small"
                                   class="mb-2"
                                   icon-pack="feather"
                                   icon="icon-plus-circle"
                                   @click="add"
                                >
                                    {{ $t('user.add') }}
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
                                        <vs-select v-model="filterRole" val-icon-danger="icon-x" val-icon-pack="feather">
                                            <vs-select-item
                                                    size="small"
                                                    :text="'- ' + $t('user.role') + ' -'"
                                                    class="w-full"/>
                                            <vs-select-item
                                                    size="small"
                                                    :key="index"
                                                    :value="index"
                                                    :text="role"
                                                    v-for="(role, index) in userRoles"
                                                    class="w-full"
                                            />
                                        </vs-select>
                                    </div>

                                    <div class="ml-3">
                                        <vs-select v-model="filterStatus" val-icon-danger="icon-x" val-icon-pack="feather">
                                            <vs-select-item
                                                    size="small"
                                                    :text="'- ' + $t('user.status') + ' -'"
                                                    class="w-full"/>
                                            <vs-select-item
                                                    size="small"
                                                    :key="index"
                                                    :value="index"
                                                    :text="item"
                                                    v-for="(item,index) in userStatuses"
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
                            <vs-td :data="data[indextr].name.fullName">
                                {{ data[indextr].name.fullName }}
                            </vs-td>
                            <vs-td :data="data[indextr].currentRole.label">
                                {{ data[indextr].currentRole.label }}
                            </vs-td>
                            <vs-td :data="data[indextr].currentStatus.label">
                                <vs-chip :color="data[indextr].currentStatus.color">
                                    {{ data[indextr].currentStatus.label }}
                                </vs-chip>
                            </vs-td>
                            <vs-td :data="data[indextr].email">
                                {{ data[indextr].email }}
                            </vs-td>
                            <vs-td :data="data[indextr].formatCreatedAt">
                                {{ data[indextr].formatCreatedAt }}
                            </vs-td>
                            <vs-td :data="data[indextr].petsCount?data[indextr].petsCount:''" class="text-center">
                                <router-link v-if="!!data[indextr].petsCount" :to="'/cabinet/pets/'+data[indextr].id">
                                    {{ data[indextr].petsCount }}
                                </router-link>
                            </vs-td>
                            <vs-td class="action-column">
                                <vs-dropdown vs-trigger-click>
                                    <vs-button radius color="primary" type="flat" icon-pack="feather" icon="icon-more-vertical"></vs-button>
                                    <vs-dropdown-menu>
                                        <router-link :to="'/cabinet/users/'+data[indextr].id">
                                            <vs-dropdown-item>
                                                {{ $t('buttons.view') }}
                                            </vs-dropdown-item>
                                        </router-link>
                                        <vs-dropdown-item @click="loginAsConfirm(data[indextr])">
                                            {{ $t('user.loginAs') }}
                                        </vs-dropdown-item>
                                    </vs-dropdown-menu>
                                </vs-dropdown>
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
                <div v-if="totalItems > maxItems" class="mt-5">
                    <vs-pagination :total="Math.ceil(totalItems/maxItems)" v-model="currentPage"></vs-pagination>
                </div>
            </div>
        </div>

        <user-add-modal v-if="modalOpened" @close="modalClose" @created="created"></user-add-modal>

    </div>
</template>

<script>
    import {BSpinner, BRow, BCol, BButton, BFormInput} from 'bootstrap-vue';
    import userAddModal from '@/modals/user-add-modal/user-add-modal.vue';
    export default {
        components: {
            BSpinner, BRow, BCol, BButton, BFormInput, userAddModal
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
                filterRole: null,
                filterStatus: null,
                modalOpened: false
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

                this.$store.dispatch('getUserList', params)
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
                this.modalOpened = true;
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
            view(item, isEdit) {
                this.$store.dispatch('openPetModal', {petId: item.id, isEdit: isEdit, modalAction: 'changed'});
            },
            modalClose() {
                this.modalOpened = false;
            },
            created() {
                this.modalOpened = false;
                this.getItems();
            },
            loginAsConfirm(user) {
                let _this = this;
                this.$vs.dialog({
                    type: 'confirm',
                    color:'warning',
                    title: this.$t('main.confirmLogin'),
                    text: this.$t('user.confirmLogin', {name: user.name.fullName}),
                    acceptText: this.$t('buttons.confirm'),
                    cancelText: this.$t('buttons.cancel'),
                    buttonsHidden: true,
                    accept:function () {
                        _this.loginAs(user.id);
                    }
                })
            },
            loginAs(userId) {
                this.$vs.loading();
                this.$store.dispatch('auth/loginAs', userId)
                    .then(res =>  {
                        window.location.reload();
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors ? err.response.data.errors : [];
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => (this.$vs.loading.close()));
            }
        },

        computed: {
            params() {
                return this.$store.state.appParams;
            },
            windowWidth() {
                return this.$store.getters.windowBreakPoint
            },
            userStatuses() {
                return this.params.userStatuses;
            },
            userRoles() {
                return this.params.userRoles;
            },
        },
        watch: {
            currentPage(val) {
                this.page = val;
                this.getItems();
            },
            filterRole(v) {
                if (v) {
                    this.filter.role = v;
                } else {
                    delete this.filter.role;
                }
                this.getItems();
            },
            filterStatus(v) {
                if (v) {
                    this.filter.status = v;
                } else {
                    delete this.filter.status;
                }

                this.getItems();
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