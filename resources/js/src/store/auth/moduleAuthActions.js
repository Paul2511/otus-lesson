/*=========================================================================================
  File Name: moduleAuthActions.js
  Description: Auth Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import jwt from '../../http/requests/auth/jwt/index.js'

import router from '@/router'

export default {
  loginAttempt ({ dispatch }, payload) {

    // New payload for login action
    const newPayload = {
      userDetails: payload.userDetails,
      notify: payload.notify,
      closeAnimation: payload.closeAnimation
    }
  },

  // JWT
  login ({ commit }, payload) {

    return new Promise((resolve, reject) => {
      jwt.login(payload.email, payload.password)
        .then(response => {

          // If there's user data in response
          if (response.data.userData) {
            // Navigate User to homepage

              //router.push(router.currentRoute.query.to || 'cabinet')

            // Set accessToken
            localStorage.setItem('accessToken', response.data.accessToken)

            // Update user details
            commit('UPDATE_USER_INFO', response.data.userData, {root: true})

            // Set bearer token in axios
            commit('SET_BEARER', response.data.accessToken)
          }
          /*else {
            reject({message: 'Wrong Email or Password'})
          }*/
            resolve(response)
        })
        .catch(error => { reject(error) })
    })
  },
  registerUser ({ commit }, payload) {

    const { displayName, email, password, confirmPassword } = payload.userDetails

    return new Promise((resolve, reject) => {

      // Check confirm password
      if (password !== confirmPassword) {
        reject({message: 'Password doesn\'t match. Please try again.'})
      }

      jwt.registerUser(displayName, email, password)
        .then(response => {
          // Redirect User
          router.push(router.currentRoute.query.to || '/')

          // Update data in localStorage
          localStorage.setItem('accessToken', response.data.accessToken)
          commit('UPDATE_USER_INFO', response.data.userData, {root: true})

          resolve(response)
        })
        .catch(error => { reject(error) })
    })
  },
  fetchAccessToken () {
    return new Promise((resolve) => {
      jwt.refreshToken().then(response => { resolve(response) })
    })
  }
}
