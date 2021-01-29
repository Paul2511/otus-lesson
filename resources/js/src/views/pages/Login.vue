<template>
    <div class="min-h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">

                    <div class="vx-row no-gutter justify-center items-center">

                        <div class="vx-col hidden lg:block lg:w-1/2">
                            <img src="@assets/images/pages/login_new.png" alt="login" class="mx-auto">
                        </div>

                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
                            <div class="p-8 login-tabs-container">

                                <div class="vx-card__title mb-6">
                                    <h4 class="mb-4">{{ $t('loginClient') }}</h4>
                                    <p>{{ $t('loginText') }}</p>
                                </div>

                                <div>
                                    <vs-input
                                            name="email"
                                            icon-no-border
                                            icon="icon icon-user"
                                            icon-pack="feather"
                                            :label-placeholder="$t('Email')"
                                            v-model="email"
                                            class="w-full"/>
                                    <span class="text-danger text-xs" v-show="!!errors.email">{{ errors.email | arr2str }}</span>

                                    <vs-input
                                            type="password"
                                            name="password"
                                            icon-no-border
                                            icon="icon icon-lock"
                                            icon-pack="feather"
                                            :label-placeholder="$t('Password')"
                                            v-model="password"
                                            class="w-full mt-6"/>
                                    <span class="text-danger text-xs" v-show="!!errors.password">{{ errors.password | arr2str }}</span>

                                    <div class="flex flex-wrap justify-between my-5">
                                        <router-link to="">{{ $t('ForgotPassword') }}?</router-link>
                                    </div>
                                    <vs-button type="border">{{ $t('Register') }}</vs-button>
                                    <vs-button @click="login" class="float-right">{{ $t('Login') }}</vs-button>

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
                email: "",
                password: "",
                checkbox_remember_me: false,
                errors: []
            }
        },
        mounted() {
            this.$vs.loading.close();
            if (this.$store.state.auth.isUserLoggedIn()) {
                this.$router.push('cabinet')
            }
        },
        methods: {
            login() {
                if (!this.checkLogin()) return;

                this.$vs.loading();

                const payload = {
                    email: this.email,
                    password: this.password
                };
                this.$store.dispatch('auth/login', payload)
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
            },
            checkLogin () {
                if (this.$store.state.auth.isUserLoggedIn()) {

                    this.$vs.notify({
                        title: 'Предупреждение',
                        text: 'Вы уже авторизованы!',
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        color: 'warning'
                    })
                    return false
                }
                return true
            }
        },
        computed: {

        },
    }
</script>

<style lang="scss">
    #page-login {
        .social-login-buttons {
            .bg-facebook {
                background-color: #1551b1
            }

            .bg-twitter {
                background-color: #00aaff
            }

            .bg-google {
                background-color: #4285F4
            }

            .bg-github {
                background-color: #333
            }
        }
    }
</style>
