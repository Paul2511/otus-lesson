<template>
    <div class="the-navbar__user-meta flex items-center"
         v-if="activeUserInfo.name && activeUserInfo.name.displayName">

        <div class="text-right leading-tight hidden sm:block">
            <p class="font-semibold">{{ activeUserInfo.name.displayName }}</p>
            <small v-if="!!activeUserInfo.specialist && !!activeUserInfo.specialist.specializationTitle">
                {{ activeUserInfo.specialist.specializationTitle }}
            </small>
        </div>

        <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">

            <div class="con-img ml-3">
                <img v-if="activeUserInfo.avatar && activeUserInfo.avatar.type !== 'default'" key="onlineImg"
                     :src="activeUserInfo.avatar.thumb_src" alt="user-img"
                     width="40" height="40" class="rounded-full shadow-md cursor-pointer block"/>
                <vs-avatar color="primary" v-else/>
            </div>

            <vs-dropdown-menu class="vx-navbar-dropdown">
                <ul>

                    <li @click="$router.push('/cabinet/profile').catch(() => {})" class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                        <feather-icon icon="UserIcon" svgClasses="w-4 h-4"/>
                        <span class="ml-2">{{ $t('main.myProfile') }}</span>
                    </li>

                    <vs-divider class="m-1"/>

                    <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white" @click="logout">
                        <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4"/>
                        <span class="ml-2">{{ $t('main.exit') }}</span>
                    </li>
                </ul>
            </vs-dropdown-menu>
        </vs-dropdown>
    </div>
</template>

<script>
    export default {
        computed: {
            activeUserInfo() {
                return this.$store.state.AppActiveUser;
            }
        },
        methods: {

            logout() {
                if (localStorage.getItem('accessToken')) {
                    localStorage.removeItem('accessToken')
                    this.$router.push('/login').catch(() => {})
                }

                this.$acl.change('public')
                localStorage.removeItem('userInfo')

            }
        }
    }
</script>

<style scoped lang="scss">
    .vx-navbar-dropdown {
        ul {
            min-width: 9rem;
            li {
                white-space: nowrap;
            }
        }
    }

</style>
