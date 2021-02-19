<template>
    <div id="page-user-view">
        <vx-card no-shadow>
            <div v-if="!!user">
                <vx-card :title="$t('user.general')" class="mb-base">
                    <template v-if="canAdmin" slot="actions">
                        <feather-icon @click="loginAsConfirm" :title="$t('user.loginAs')" icon="LogInIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                    </template>
                    <user-settings-general-view :user="user" @edit="edit" v-if="!editing" />
                    <user-settings-general-edit v-if="editing" :user-info="user" @cancel="cancel" @set="setUser" />
                </vx-card>
            </div>
        </vx-card>
    </div>
</template>

<script>
    import UserSettingsGeneralView from './user-settings-general/UserSettingsGeneralView.vue'
    import UserSettingsGeneralEdit from './user-settings-general/UserSettingsGeneralEdit.vue'
    export default {
        components: {
            UserSettingsGeneralView, UserSettingsGeneralEdit
        },
        data() {
            return {
                editing: false,
                user: null
            }
        },
        created() {
            let action = 'getProfile';
            let userId = this.userId;
            if (userId) {
                action = 'getUser';
            } else {
                userId = null;
            }

            this.$vs.loading();
            this.$store.dispatch(action, userId)
                .then(res => {
                    this.user = res.data.data;
                })
                .catch(err => {
                    this.$vs.notify({
                        title: this.$t('Error'),
                        text: err.response.data.message || this.$t('ErrorResponse'),
                        color: 'danger', iconPack: 'feather', icon:'icon-alert-circle'})
                })
                .finally(() => (this.$vs.loading.close()));
        },
        methods: {
            edit() {
                this.editing = true;
            },
            cancel() {
                this.editing = false;
            },
            setUser(user) {
                this.user = user;
                this.editing = false;
            },
            loginAsConfirm() {
                let _this = this;
                this.$vs.dialog({
                    type: 'confirm',
                    color:'warning',
                    title: this.$t('main.confirmLogin'),
                    text: this.$t('user.confirmLogin', {name: _this.user.name.fullName}),
                    acceptText: this.$t('buttons.confirm'),
                    cancelText: this.$t('buttons.cancel'),
                    buttonsHidden: true,
                    accept:function () {
                        _this.loginAs();
                    }
                })
            },
            loginAs() {
                this.$vs.loading();
                this.$store.dispatch('auth/loginAs', this.user.id)
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
            canAdmin() {
                return this.$acl.check('canAdmin')
            },
            userId() {
                return this.$route.params.userId;
            }
        }
    }
</script>

<style lang="scss">
    #avatar-col {
        width: 10rem;
    }

    #page-user-view {
        table {
            td {
                vertical-align: top;
                min-width: 140px;
                padding-bottom: .8rem;
                word-break: break-all;
            }

            &:not(.permissions-table) {
                td {
                    @media screen and (max-width:370px) {
                        display: block;
                    }
                }
            }
        }
    }


    @media screen and (min-width:1201px) and (max-width:1211px),
    only screen and (min-width:636px) and (max-width:991px) {
        #account-info-col-1 {
            width: calc(100% - 12rem) !important;
        }
    }

</style>
