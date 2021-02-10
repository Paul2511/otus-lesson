/*=========================================================================================
  File Name: actions.js
  Description: Vuex Store - actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import axios from '@/axios.js'
import * as requests from './../http/requests/consts.js';

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
            axios.get(requests.PROFILE)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        })
    },
    getUser({commit}, userId) {

        return new Promise((resolve, reject) => {
            axios.get(requests.GET_USER(userId))
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        })
    },
    updateUser({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.put(requests.UPDATE_USER(data.userId), data.data)
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
            axios.get(requests.GET_PETS)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    getPetsList({ commit }, queryData) {
        if (typeof queryData !== 'object') {
            queryData = {};
        }
        return new Promise((resolve, reject) => {
            axios.get(requests.GET_ALL_PETS, {
                params: queryData,
            })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    getUserPets({ commit }, userId) {
        return new Promise((resolve, reject) => {
            axios.get(requests.GET_USER_PETS(userId))
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    deletePet({ commit }, petId) {
        return new Promise((resolve, reject) => {
            axios.delete(requests.DELETE_PET(petId))
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    getPet({ commit }, petId) {
        return new Promise((resolve, reject) => {
            axios.get(requests.GET_PET(petId))
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    updatePet({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.put(requests.UPDATE_PET(data.petId), data.data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    createPet({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.post(requests.CREATE_PET, data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    // /////////////////////////////////////////////
    // PetTypes
    // /////////////////////////////////////////////
    getPetTypes({ commit }, queryData) {
        if (typeof queryData !== 'object') {
            queryData = {};
        }
        return new Promise((resolve, reject) => {
            axios.get(requests.GET_PET_TYPES, {
                params: queryData
            })
            .then((response) => {
                resolve(response);
            })
            .catch((error) => { reject(error) })
        });
    },
    createPetType({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.post(requests.CREATE_PET_TYPE, data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    updatePetType({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.put(requests.UPDATE_PET_TYPE(data.id), data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    deletePetType({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios.delete(requests.DELETE_PET_TYPE(id))
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },

    // /////////////////////////////////////////////
    // Specializations
    // /////////////////////////////////////////////
    getSpecializations({ commit }, queryData) {
        if (typeof queryData !== 'object') {
            queryData = {};
        }
        return new Promise((resolve, reject) => {
            axios.get(requests.GET_SPECIALIZATIONS, {
                params: queryData
            })
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    createSpecialization({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.post(requests.CREATE_SPECIALIZATION, data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    updateSpecialization({ commit }, data) {
        return new Promise((resolve, reject) => {
            axios.put(requests.UPDATE_SPECIALIZATION(data.id), data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => { reject(error) })
        });
    },
    deleteSpecialization({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios.delete(requests.DELETE_SPECIALIZATION(id))
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
                requests.UPLOAD_IMAGE,
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
