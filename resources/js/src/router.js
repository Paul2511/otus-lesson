/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


const router = new Router({
    mode: 'history',
    base: '/',
    scrollBehavior() {
        return {x: 0, y: 0}
    },
    routes: [
        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: '/',
                    redirect: '/home',
                },
                {
                    path: '/cabinet',
                    name: 'cabinet',
                    component: () => import('./views/cabinet/Dashboard.vue'),
                    meta: {
                        rule: 'inter'
                    }
                },
                {
                    path: '/cabinet/profile',
                    name: 'profile',
                    component: () => import('./views/cabinet/user-settings/UserSettings.vue'),
                    meta: {
                        rule: 'inter'
                    }
                },
                {
                    path: '/cabinet/pets',
                    name: 'pets',
                    component: () => import('./views/cabinet/pets/Pets.vue'),
                    meta: {
                        rule: 'client'
                    }
                },
                {
                    path: '/cabinet/references/pet-types',
                    name: 'petTypes',
                    component: () => import('./views/cabinet/admin/references/pet-types/pet-types.vue'),
                    meta: {
                        rule: 'admin'
                    }
                },
                {
                    path: '/cabinet/references/specializations',
                    name: 'specializations',
                    component: () => import('./views/cabinet/admin/references/specializations/specializations.vue'),
                    meta: {
                        rule: 'admin'
                    }
                },
            ],
        },
        
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '/home',
                    name: 'home',
                    component: () => import('@/views/pages/Home.vue'),
                    meta: {
                        rule: 'public'
                    }
                },
                {
                    path: '/login',
                    name: 'login',
                    component: () => import('@/views/pages/Login.vue'),
                    meta: {
                        rule: '*'
                    }
                },
                {
                    path: '/error-404',
                    name: 'error-404',
                    component: () => import('@/views/pages/Error404.vue'),
                    meta: {
                        rule: 'public'
                    }
                },
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/error-404'
        }
    ],
});

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
});



export default router
