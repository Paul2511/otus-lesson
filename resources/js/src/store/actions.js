/*=========================================================================================
  File Name: actions.js
  Description: Vuex Store - actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import axios from 'axios'

const actions = {

    // /////////////////////////////////////////////
    // COMPONENTS
    // /////////////////////////////////////////////

    // Vertical NavMenu
    updateVerticalNavMenuWidth({commit}, width) {
        commit('UPDATE_VERTICAL_NAV_MENU_WIDTH', width)
    },

    // VxAutoSuggest
    updateStarredPage({commit}, payload) {
        commit('UPDATE_STARRED_PAGE', payload)
    },

    // The Navbar
    arrangeStarredPagesLimited({commit}, list) {
        commit('ARRANGE_STARRED_PAGES_LIMITED', list)
    },
    arrangeStarredPagesMore({commit}, list) {
        commit('ARRANGE_STARRED_PAGES_MORE', list)
    },

    // /////////////////////////////////////////////
    // UI
    // /////////////////////////////////////////////

    toggleContentOverlay({commit}) {
        commit('TOGGLE_CONTENT_OVERLAY')
    },
    updateTheme({commit}, val) {
        commit('UPDATE_THEME', val)
    },

    // /////////////////////////////////////////////
    // User/Account
    // /////////////////////////////////////////////

    getUserInfo({commit}) {
        if (!this.state.AppActiveUser.id) {
            axios.get('/api/users/7')
                .then((response) => {
                    commit('SET_USER_INFO', response.data.user)
                })
                .catch((error) => {
                    this.$vs.notify({title: this.$t('Error'), text: this.$t('ErrorResponse'), color: 'danger'})
                })
        }
    },

    updateUserInfo({ commit }, user) {
        return new Promise((resolve, reject) => {
            axios.post('/api/users/'+user.id, {data: user, _method: 'patch'})
                .then((response) => {
                    if (response.data.success) {
                        commit('SET_USER_INFO', response.data.user);
                    }
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    // /////////////////////////////////////////////
    // Pets
    // /////////////////////////////////////////////
    getUserPets({ commit }, userId) {
        return new Promise((resolve, reject) => {
            axios.get('/api/pets/?user_id='+userId)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    deletePet({ commit }, petId) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/pets/'+petId)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

};

export default actions
