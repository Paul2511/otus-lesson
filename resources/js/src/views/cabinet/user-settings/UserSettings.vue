<template>
    <vs-tabs :position="isSmallerScreen ? 'top' : 'left'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">
        <vs-tab icon-pack="feather" icon="icon-user" :label="!isSmallerScreen ? $t('userSettingsGeneral') : ''">
            <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
                <user-settings-general />
            </div>
        </vs-tab>
        <vs-tab icon-pack="feather" icon="icon-lock" :label="!isSmallerScreen ? $t('userSettingsChangePassword') : ''">
            <div class="tab-change-pwd md:ml-4 md:mt-0 mt-4 ml-0">
                <user-settings-change-password />
            </div>
        </vs-tab>

        <vs-tab v-if="canAdmin && userId" icon-pack="feather" icon="icon-message-square" :label="!isSmallerScreen ? $t('comments') : ''">
            <div class="tab-change-pwd md:ml-4 md:mt-0 mt-4 ml-0">
                <user-setting-comments/>
            </div>
        </vs-tab>

    </vs-tabs>
</template>

<script>
    import UserSettingsGeneral from './UserSettingsGeneral.vue'
    import UserSettingsChangePassword from './UserSettingsChangePassword.vue'
    import UserSettingComments from './UserSettingsComments.vue'

    export default {
        components: {
            UserSettingsGeneral, UserSettingsChangePassword, UserSettingComments
        },
        data() {
            return {

            }
        },

        mounted() {

        },

        computed: {
            isSmallerScreen () {
                return this.$store.state.windowWidth < 768
            },
            canAdmin() {
                return this.$acl.check('canAdmin')
            },
            userId() {
                return this.$route.params.userId;
            }
        },
    }
</script>

<style lang="scss">
    #profile-tabs {
        .vs-tabs--content {
            padding: 0;
        }
    }
</style>