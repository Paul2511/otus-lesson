<template>
    <div @keyup.enter="save" @keyup.esc="cancel">

        <div class="vx-row mb-8">
            <div class="vx-col w-full">
                <div class="flex items-start flex-col sm:flex-row">
                    <img :src="detail.avatar.src" class="mr-8 rounded h-32 w-32" />
                    <div>
                        <input type="file" class="hidden" ref="update_avatar_input" @change="uploadAvatar" accept="image/*">

                        <vs-button
                            id="button-upload-avatar"
                            class="mr-4 mb-2"
                            @click="$refs.update_avatar_input.click()"
                            :disabled="uploading"
                        >
                            {{ changeAvatarLabel }}
                        </vs-button>

                        <vs-button v-if="showAvatarDelete" @click="deleteAvatar" type="border" color="danger">Удалить аватар</vs-button>

                        <p class="text-danger text-xs" v-show="!!errors.file">{{ errors.file | arr2str }}</p>

                    </div>

                </div>
            </div>
        </div>

        <div class="vx-row">
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

            <div class="vx-col w-full flex mt-4">
                <vs-button @click.native="save" :disabled="!userData && !detailData || uploading" icon-pack="feather" color="success" icon="icon-save" class="mr-4">Сохранить</vs-button>
                <vs-button type="border" @click.native="cancel">Отмена</vs-button>
            </div>
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
                detailData: null,
                uploading: false,
                defaultAvatar: {
                    src: '/images/no-avatar.jpg',
                    type: 'default'
                }
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
            },
            uploadAvatar () {
                this.uploading = true;

                if (!!this.errors.file) {
                    this.errors.file = null;
                }

                this.$vs.loading({
                    container: "#button-upload-avatar",
                    scale: 0.45
                });

                let formData = new FormData();

                let image = this.$refs.update_avatar_input.files[0];
                formData.append('image', image);
                formData.append('uploadPath', 'user.avatar');
                formData.append('userId', this.user.id);

                this.$store.dispatch('uploadImage', formData)
                    .then(res => {
                        if (res.data.success && !!res.data.fileData) {
                            this.detail.avatar = res.data.fileData;
                            this.setDetailData('avatar');
                        }
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors ? err.response.data.errors : [];
                        this.$vs.notify({
                            title: this.$t('Error'),
                            text: err.response.data.message || this.$t('ErrorResponse'),
                            color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                    })
                    .finally(() => {
                        this.uploading = false;
                        this.$vs.loading.close("#button-upload-avatar > .con-vs-loading");
                    });
            },
            deleteAvatar() {
                this.detail.avatar = this.defaultAvatar;
                this.setDetailData('avatar');
            }
        },
        computed: {
            canAdmin() {
                return this.$acl.check('canAdmin')
            },
            changeAvatarLabel() {
                const avatar = this.detail.avatar;
                if (!avatar.type || avatar.type === 'default') {
                    return 'Загрузить аватар';
                }
                return 'Сменить аватар';
            },
            showAvatarDelete() {
                const avatar = this.detail.avatar;
                if (!!avatar.type && avatar.type === 'default') {
                    return false;
                }
                return true;
            }
        }
    }

</script>