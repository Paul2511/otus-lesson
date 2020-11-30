<template>
    <div id="page-user-view">
        <vx-card no-shadow>
            <div v-if="isLoading" class="loading-block"><div class="loading-inner"></div></div>
            <div v-else>
                <vx-card title="Основные данные" class="mb-base">
                    <user-settings-general-view :user="user" @edit="edit" v-if="!editing" />
                    <user-settings-general-edit v-if="editing" :user-info="user" @cancel="cancel" />
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
                editing: false
            }
        },
        mounted(){
            if (this.isLoading) {
                this.$vs.loading({
                    container: '.loading-inner',
                    type:'point'
                });
            }
        },
        created() {
            this.$store.dispatch('getUserInfo');
        },
        methods: {
            edit() {
                this.editing = true;
            },
            cancel() {
                this.editing = false;
            }
        },
        computed: {
            user() {
                return this.$store.state.AppActiveUser
            },
            isLoading() {
                return !this.user.id;
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
