<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row">
                        <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
                            <img src="@assets/images/pages/forgot-password.png" alt="login" class="mx-auto">
                        </div>
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center d-theme-dark-bg">
                            <div class="p-8">
                                <div class="vx-card__title mb-8">
                                    <h4 class="mb-4">{{ $t('register.recoverTitle') }}</h4>
                                    <p>{{ $t('register.recoverText') }}</p>
                                </div>

                                <div class="mb-8">
                                    <vs-input type="email" label-placeholder="Email" v-model="item.email" class="w-full"/>
                                    <span class="text-danger text-xs" v-if="!!errors.email && !!errors.email[0]">{{ errors.email[0] }}</span>
                                </div>

                                <vs-button to="/login" type="border" class="px-4 w-full md:w-auto">
                                    {{ $t('register.backLogin') }}
                                </vs-button>
                                <vs-button @click="send" class="float-right px-4 w-full md:w-auto mt-3 mb-8 md:mt-0 md:mb-0">
                                    {{ $t('register.recoverPassword') }}
                                </vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                item: {
                    'email': ''
                },
                errors: [],
            }
        },
        methods: {
            checkLogin() {
                if (this.$store.state.auth.isUserLoggedIn()) {

                    this.$vs.notify({
                        title: this.$t('warning'),
                        text: this.$t('loginError'),
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        color: 'warning'
                    })
                    return false
                }
                return true
            },

            send() {
                if (!this.checkLogin()) return;

                this.$vs.loading();
                this.$store.dispatch('forgotPassword', this.item)
                    .then(res => {
                        if (!!res.data.message) {
                            this.$store.commit('SET_LOGIN_MSG', res.data.message);
                        }

                        this.$router.push('/login').catch(() => {})
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
        }
    }
</script>
