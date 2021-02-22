<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col sm:w-3/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row">
                        <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
                            <img src="@assets/images/pages/reset-password.png" alt="login" class="mx-auto">
                        </div>
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center  d-theme-dark-bg">
                            <div class="p-8">
                                <div class="vx-card__title mb-8">
                                    <h4 class="mb-4">{{ $t('register.resetTitle') }}</h4>
                                    <p>{{ $t('register.resetText') }}</p>
                                </div>

                                <div class="mb-6">
                                    <vs-input type="email" label-placeholder="Email" placeholder="Email" v-model="item.email" class="w-full"/>
                                    <span class="text-danger text-xs" v-if="!!errors.email && !!errors.email[0]">{{ errors.email[0] }}</span>
                                </div>

                                <div class="mb-6">
                                    <vs-input type="password" :label-placeholder="$t('register.password')"
                                              :placeholder="$t('register.password')"
                                              v-model="item.password" class="w-full"/>
                                    <span class="text-danger text-xs" v-if="!!errors.password && !!errors.password[0]">{{ errors.password[0] }}</span>
                                </div>

                                <div class="mb-8">
                                    <vs-input type="password"
                                              name="password_confirmation"
                                              :label-placeholder="$t('register.confirmPassword')"
                                              :placeholder="$t('register.confirmPassword')"
                                              v-model="item.password_confirmation" class="w-full"/>
                                    <span class="text-danger text-xs" v-if="!!errors.password_confirmation && !!errors.password_confirmation[0]">{{ errors.password_confirmation[0] }}</span>
                                </div>

                                <div class="flex flex-wrap justify-between flex-col-reverse sm:flex-row">
                                    <vs-button type="border" to="/login" class="w-full sm:w-auto mb-8 sm:mb-auto mt-3 sm:mt-auto">
                                        {{ $t('register.backLogin') }}
                                    </vs-button>
                                    <vs-button @click="resetPassword" class="w-full sm:w-auto">{{ $t('register.resetPassword') }}</vs-button>
                                </div>

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
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: []
            }
        },
        mounted() {
            if (!!this.email) {
                this.item.email = this.email;
            }
            if (!!this.token) {
                this.item.token = this.token;
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

            resetPassword() {
                if (!this.checkLogin()) return;

                this.$vs.loading();
                this.$store.dispatch('resetPassword', this.item)
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

        },
        computed: {
            token() {
                return this.$route.params.token;
            },
            email() {
                return this.$route.query.email;
            }
        }
    }
</script>