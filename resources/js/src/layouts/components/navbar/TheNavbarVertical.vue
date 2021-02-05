<!-- =========================================================================================
  File Name: TheNavbar.vue
  Description: Navbar component
  Component Name: TheNavbar
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="relative">

        <div class="vx-navbar-wrapper" :class="classObj">

            <vs-navbar class="vx-navbar navbar-custom navbar-skelton" :color="navbarColorLocal" :class="textColor">

                <div v-if="windowWidth >= 992">
                    <h3>{{ $t(headerTitle) }}</h3>
                </div>

                <!-- SM - OPEN SIDEBAR BUTTON -->
                <feather-icon class="sm:inline-flex xl:hidden cursor-pointer p-2" icon="MenuIcon"
                              @click.stop="showSidebar"/>

                <bookmarks :navbarColor="navbarColor" v-if="0 && windowWidth >= 992"/>

                <vs-spacer/>

                <i18n />

                <search-bar class="mr-4" v-if="0"/>

                <notification-drop-down v-if="0"/>

                <profile-drop-down/>

            </vs-navbar>
        </div>
    </div>
</template>


<script>
    import Bookmarks from './components/Bookmarks.vue'
    import SearchBar from './components/SearchBar.vue'
    import NotificationDropDown from './components/NotificationDropDown.vue'
    import ProfileDropDown from './components/ProfileDropDown.vue'
    import navMenuItems from '@/layouts/components/vertical-nav-menu/navMenuItems.js'
    import I18n from './components/I18n.vue'

    export default {
        name: 'the-navbar-vertical',
        props: {
            navbarColor: {
                type: String,
                default: '#fff'
            }
        },
        components: {
            Bookmarks,
            SearchBar,
            NotificationDropDown,
            ProfileDropDown,
            I18n
        },
        data() {
            return {
                navMenuItems,
                headerTitle: ''
            }
        },
        mounted() {
            this.setTitle();
        },
        computed: {
            navbarColorLocal() {
                return this.$store.state.theme === 'dark' && this.navbarColor === '#fff' ? '#10163a' : this.navbarColor
            },
            verticalNavMenuWidth() {
                return this.$store.state.verticalNavMenuWidth
            },
            textColor() {
                return {'text-white': (this.navbarColor !== '#10163a' && this.$store.state.theme === 'dark') || (this.navbarColor !== '#fff' && this.$store.state.theme !== 'dark')}
            },
            windowWidth() {
                return this.$store.state.windowWidth
            },

            // NAVBAR STYLE
            classObj() {
                if (this.verticalNavMenuWidth === 'default') return 'navbar-default'
                else if (this.verticalNavMenuWidth === 'reduced') return 'navbar-reduced'
                else if (this.verticalNavMenuWidth) return 'navbar-full'
            },
            currentPath() {
                return this.$route.path;
            }
        },
        methods: {
            showSidebar() {
                this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', true)
            },
            setTitle() {
                let item = this.navMenuItems.find((n) => {
                    if (!n.url && !!n.submenu) {
                        return n.submenu.find(s => s.url === this.currentPath);
                    }
                    return n.url === this.currentPath;
                });
                if (item) {
                    this.headerTitle = item.i18n ? item.i18n : item.name;
                }
            }
        },
        watch: {
            currentPath() {
                this.setTitle();
            }
        },
    }
</script>

