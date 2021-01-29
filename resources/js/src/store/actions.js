/*=========================================================================================
  File Name: actions.js
  Description: Vuex Store - actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import axios from '@/axios.js'

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

    updateUserInfo ({ commit }, payload) {
        commit('UPDATE_USER_INFO', payload)
    },

    getProfile() {
        return new Promise((resolve, reject) => {
            axios.get('/api/auth/profile')
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        })
    },

    getUser({commit}, userId) {

        return new Promise((resolve, reject) => {
            axios.get('/api/users/'+userId)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        })
    },
    updateUser({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.put('/api/users/'+data.userId, data.data)
                .then((response) => {
                    commit('UPDATE_USER_INFO', response.data.data);
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    // /////////////////////////////////////////////
    // Pets
    // /////////////////////////////////////////////

    getPets() {
        return new Promise((resolve, reject) => {
            axios.get('/api/pets')
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    getUserPets({ commit }, userId) {
        return new Promise((resolve, reject) => {
            axios.get('/api/users/'+userId+'/pets')
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
    getPet({ commit }, petId) {
        return new Promise((resolve, reject) => {
            axios.get('/api/pets/'+petId)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    updatePet({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.put('/api/pets/'+data.petId, data.data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    createPet({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.post('/api/pets/', data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    // /////////////////////////////////////////////
    // Files
    // /////////////////////////////////////////////
    //Загрузка одного изображения
    uploadImage({ commit }, formData) {
        return new Promise((resolve, reject) => {
            axios.post(
                '/api/files/upload-image',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    // /////////////////////////////////////////////
    // Modals
    // /////////////////////////////////////////////
    openPetModal({ commit }, data) {
        commit('OPEN_PET_MODAL', data);
    },

    closePetModal({ commit }) {
        commit('CLOSE_PET_MODAL');
    },

    openPetCreateModal({ commit }) {
        commit('OPEN_PET_CREATE_MODAL');
    },

    closePetCreateModal({ commit }) {
        commit('CLOSE_PET_CREATE_MODAL');
    }
};

export default actions
