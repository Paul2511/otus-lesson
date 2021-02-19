<template>
    <div class="clearfix">
        <vs-input
                name="email"
                type="email"
                label-placeholder="Email"
                placeholder="Email"
                v-model="item.email"
                class="w-full mt-6"/>
        <span class="text-danger text-xs" v-if="!!errors.email && !!errors.email[0]">{{ errors.email[0] }}</span>

        <vs-input
                type="password"
                name="password"
                :label-placeholder="$t('register.password')"
                :placeholder="$t('register.password')"
                v-model="item.password"
                class="w-full mt-6"/>
        <span class="text-danger text-xs" v-if="!!errors.password && !!errors.password[0]">{{ errors.password[0] }}</span>

        <vs-input
                type="password"
                name="password_confirmation"
                :label-placeholder="$t('register.confirmPassword')"
                :placeholder="$t('register.confirmPassword')"
                v-model="item.password_confirmation"
                class="w-full mt-6"/>
        <span class="text-danger text-xs" v-if="!!errors.password_confirmation && !!errors.password_confirmation[0]">{{ errors.password_confirmation[0] }}</span>

        <vs-button type="border" to="/login" class="mt-6">{{ $t('Login') }}</vs-button>
        <vs-button class="float-right mt-6" @click="registerClient">{{ $t('register.button') }}</vs-button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                item: {},
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
            registerClient() {
                if (!this.checkLogin()) return;

                this.$vs.loading();
                this.$store.dispatch('registerClient', this.item)
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
