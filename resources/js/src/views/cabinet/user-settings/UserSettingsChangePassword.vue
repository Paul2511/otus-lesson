<template>
    <vx-card no-shadow>
        <div class="mb-base" v-if="!canAdmin || !userId">
            <vs-input type="password" class="w-full" :label-placeholder="$t('user.oldPassword')" v-model="oldPassword"/>
            <span class="text-danger text-xs" v-if="!!errors.oldPassword && !!errors.oldPassword[0]">{{ errors.oldPassword[0] }}</span>
        </div>

        <div class="mb-base">
            <vs-input type="password" class="w-full" :label-placeholder="$t('user.newPassword')" v-model="newPassword"/>
            <span class="text-danger text-xs" v-if="!!errors.newPassword && !!errors.newPassword[0]">{{ errors.newPassword[0] }}</span>
        </div>

        <div class="mb-base">
            <vs-input type="password" class="w-full" :label-placeholder="$t('user.confirmNewPassword')" v-model="confirmNewPassword"/>
            <span class="text-danger text-xs" v-if="!!errors.newPassword_confirmation && !!errors.newPassword_confirmation[0]">{{ errors.newPassword_confirmation[0] }}</span>
        </div>

        <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click="save">{{ $t('buttons.save') }}</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset">{{ $t('buttons.reset') }}</vs-button>
        </div>
    </vx-card>
</template>

<script>
    export default {
        data() {
            return {
                oldPassword: '',
                newPassword: '',
                confirmNewPassword: '',
                errors: [],
            }
        },

        methods: {
            reset() {
                this.oldPassword = '';
                this.newPassword = '';
                this.confirmNewPassword = '';
                this.errors = [];
            },
            save() {
                let payload = {
                    oldPassword: this.oldPassword,
                    newPassword: this.newPassword,
                    newPassword_confirmation: this.confirmNewPassword
                };

                if (this.canAdmin && this.userId) {
                    payload.userId = this.userId;
                }

                this.$vs.loading();
                this.$store.dispatch('changePassword', payload)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$vs.notify({title:res.data.message.title, text: res.data.message.text, color: 'success', iconPack: 'feather', icon:'icon-check'});
                        }
                        this.reset();
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
            },
            userId() {
                return this.$route.params.userId;
            }
        }
    }
</script>
