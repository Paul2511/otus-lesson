<template>
    <div class="vx-row" @keyup.enter="save" @keyup.esc="cancel">

        <!-- Information - Col 1 -->
        <div class="vx-col flex-1" id="account-info-col-1">
            <table>
                <tr>
                    <td class="font-semibold">Фамилия</td>
                    <td>
                        <vs-input @change="setDetailData('lastname')" v-model="detail.lastname" :danger="!!errors.lastname" val-icon-danger="icon-x" val-icon-pack="feather" />
                        <span class="text-danger text-xs" v-show="!!errors.lastname">{{ errors.lastname | arr2str }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold">Имя</td>
                    <td>
                        <vs-input @change="setDetailData('firstname')" v-model="detail.firstname" :danger="!!errors.firstname" val-icon-danger="icon-x" val-icon-pack="feather"/>
                        <span class="text-danger text-xs" v-show="!!errors.firstname">{{ errors.firstname | arr2str }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold">Отчество</td>
                    <td>
                        <vs-input @change="setDetailData('middlename')" v-model="detail.middlename" :danger="!!errors.middlename" val-icon-danger="icon-x" val-icon-pack="feather"/>
                        <span class="text-danger text-xs" v-show="!!errors.middlename">{{ errors.middlename | arr2str }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- /Information - Col 1 -->
        <!-- Information - Col 2 -->
        <div class="vx-col flex-1" id="account-info-col-2">
            <table>
                <tr>
                    <td class="font-semibold">Телефон</td>
                    <td>{{ user.phoneFormat }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Email</td>
                    <td>
                        {{ user.email }}
                        <template v-if="0">
                            <vs-input @change="setUserData('email')" type="email" v-model="user.email" :danger="!!errors.email" val-icon-danger="icon-x" val-icon-pack="feather"/>
                            <span class="text-danger text-xs" v-show="!!errors.email">{{ errors.email | arr2str }}</span>
                        </template>
                    </td>
                </tr>
                <tr v-if="canAdmin">
                    <td class="font-semibold">Статус</td>
                    <td>
                        <vs-select @change="setUserData('status')" v-model="user.status" class="w-full" :danger="!!errors.status" val-icon-danger="icon-x" val-icon-pack="feather">
                            <vs-select-item :key="index" :value="index" :text="item" v-for="(item,index) in user.statusLabels" class="w-full" />
                        </vs-select>
                        <span class="text-danger text-xs" v-show="!!errors.status">{{ errors.status | arr2str }}</span>
                    </td>
                </tr>

                <tr v-if="canAdmin">
                    <td class="font-semibold">Роль</td>
                    <td>{{ user.roleLabel }}</td>
                </tr>
                <tr v-if="!!user.detail.specialization">
                    <td class="font-semibold">Специализация</td>
                    <td>{{ user.detail.specialization.name }}</td>
                </tr>
            </table>
        </div>
        <!-- /Information - Col 2 -->

        <div class="vx-col w-full flex">
            <vs-button @click.native="save" :disabled="!userData && !detailData" icon-pack="feather" color="success" icon="icon-save" class="mr-4">Сохранить</vs-button>
            <vs-button type="border" @click.native="cancel">Отмена</vs-button>
        </div>
    </div>
</template>

<script>
    import Vue from 'Vue'
    export default {
        props: {
            userInfo: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                user: Object.assign({}, this.userInfo),
                detail: Object.assign({}, this.userInfo.detail),
                errors: [],
                userData: null,
                detailData: null
            }
        },
        methods: {
            setUserData(field) {
                if (!this.userData) {
                    this.userData = {};
                }
                const val = this.user[field];
                Vue.set(this.userData, field, val);
            },
            setDetailData(field) {
                if (!this.detailData) {
                    this.detailData = {};
                }
                const val = this.detail[field];
                Vue.set(this.detailData, field, val);
            },

            cancel() {
                this.$emit('cancel');
            },
            save() {
                if (this.detailData) {
                    if (!this.userData) {
                        this.userData = {};
                    }
                    Vue.set(this.userData, 'detail', this.detailData);
                }

                this.$vs.loading();

                this.$store.dispatch('updateUser', {userId: this.user.id, data: this.userData})
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.$emit('set', res.data.user);
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
            canAdmin() {
                return this.$acl.check('canAdmin')
            }
        }
    }

</script>