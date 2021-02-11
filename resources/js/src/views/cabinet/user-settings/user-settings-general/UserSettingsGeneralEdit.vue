<template>
    <div @keyup.enter="save" @keyup.esc="cancel">

        <div class="vx-row mb-8">
            <div class="vx-col w-full">
                <div class="flex items-start flex-col sm:flex-row">
                    <img :src="user.avatar.src" class="mr-8 rounded h-32 w-32" />
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

                        <vs-button v-if="showAvatarDelete" @click="deleteAvatar" type="border" color="danger">{{ $t('user.deleteAvatar') }}</vs-button>

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
                        <td class="font-semibold">{{ $t('user.lastname') }}</td>
                        <td>
                            <vs-input @change="setUserName('lastName', $event.target.value)" :value="name.lastName" :danger="!!errors.lastName" val-icon-danger="icon-x" val-icon-pack="feather" />
                            <span class="text-danger text-xs" v-show="!!errors.lastname">{{ errors.lastname | arr2str }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold">{{ $t('user.firstname') }}</td>
                        <td>
                            <vs-input @change="setUserName('firstName', $event.target.value)" :value="name.firstName" :danger="!!errors.firstName" val-icon-danger="icon-x" val-icon-pack="feather"/>
                            <span class="text-danger text-xs" v-show="!!errors.firstName">{{ errors.firstName | arr2str }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold">{{ $t('user.middlename') }}</td>
                        <td>
                            <vs-input @change="setUserName('middleName', $event.target.value)" :value="name.middleName" :danger="!!errors.middleName" val-icon-danger="icon-x" val-icon-pack="feather"/>
                            <span class="text-danger text-xs" v-show="!!errors.middleName">{{ errors.middleName | arr2str }}</span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- /Information - Col 1 -->
            <!-- Information - Col 2 -->
            <div class="vx-col flex-1" id="account-info-col-2">
                <table>
                    <tr>
                        <td class="font-semibold">{{ $t('user.phone') }}</td>
                        <td>{{ user.phone.formatPhone }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">{{ $t('user.email') }}</td>
                        <td>
                            {{ user.email }}
                        </td>
                    </tr>
                    <tr v-if="canAdmin">
                        <td class="font-semibold">{{ $t('user.status') }}</td>
                        <td>
                            <vs-select @change="setUserData('status')" v-model="user.currentStatus.status" class="w-full" :danger="!!errors.status" val-icon-danger="icon-x" val-icon-pack="feather">
                                <vs-select-item :key="index" :value="index" :text="item" v-for="(item,index) in userStatuses" class="w-full" />
                            </vs-select>
                            <span class="text-danger text-xs" v-show="!!errors.status">{{ errors.status | arr2str }}</span>
                        </td>
                    </tr>

                    <tr v-if="canAdmin">
                        <td class="font-semibold">{{ $t('user.role') }}</td>
                        <td>{{ user.currentRole.label }}</td>
                    </tr>
                    <tr v-if="!!user.specialist && !!user.specialist.specializationTitle">
                        <td class="font-semibold">{{ $t('user.specialization') }}</td>
                        <td>{{ user.specialist.specializationTitle }}</td>
                    </tr>
                </table>
            </div>
            <!-- /Information - Col 2 -->

            <div class="vx-col w-full flex mt-4">
                <vs-button @click.native="save" :disabled="!userData || uploading" icon-pack="feather" color="success" icon="icon-save" class="mr-4">
                    {{ $t('buttons.save') }}
                </vs-button>
                <vs-button type="border" @click.native="cancel">
                    {{ $t('buttons.cancel') }}
                </vs-button>
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
                name: {},
                errors: [],
                userData: null,
                uploading: false
            }
        },
        mounted() {
            this.name = Object.assign({}, this.user.name)
        },
        methods: {
            setUserData(field) {
                if (!this.userData) {
                    this.userData = {};
                }
                const val = this.user[field];

                Vue.set(this.userData, field, val);
            },
            setUserName(field, value) {
                if (!this.name) {
                    this.name = {};
                }

                Vue.set(this.name, field, value);
                if (!this.userData) {
                    this.userData = {};
                }
                Vue.set(this.userData, 'name', this.name);
            },
            cancel() {
                this.$emit('cancel');
            },
            save() {
                this.$vs.loading();

                this.$store.dispatch('updateUser', {userId: this.user.id, data: this.userData})
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.$emit('set', res.data.data);
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
                formData.append('id', this.user.id);
                this.$store.dispatch('uploadImage', formData)
                    .then(res => {
                        if (res.data.data) {
                            this.user.avatar = res.data.data;
                            this.setUserData('avatar');
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
                this.user.avatar = this.defaultAvatar;
                this.setUserData('avatar');
            }
        },

        computed: {
            canAdmin() {
                return this.$acl.check('canAdmin')
            },
            changeAvatarLabel() {
                const avatar = this.user.avatar;
                if (!avatar.type || avatar.type === 'default') {
                    return this.$t('user.uploadAvatar');
                }
                return this.$t('user.changeAvatar');
            },
            showAvatarDelete() {
                const avatar = this.user.avatar;
                if (!!avatar.type && avatar.type === 'default') {
                    return false;
                }
                return true;
            },
            params() {
                return this.$store.state.appParams;
            },
            defaultAvatar() {
                return this.params.defaultAvatar;
            },
            userStatuses() {
                return this.params.userStatuses;
            }
        }
    }

</script>