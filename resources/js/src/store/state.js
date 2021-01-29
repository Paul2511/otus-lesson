/*=========================================================================================
  File Name: state.js
  Description: Vuex Store - state
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import navbarSearchAndPinList from "@/layouts/components/navbar/navbarSearchAndPinList"
import themeConfig from "@/../themeConfig.js"
import colors from "@/../themeConfig.js"

// /////////////////////////////////////////////
// Helper
// /////////////////////////////////////////////

const userDefaults = {
    id: '',
    role: "public",
    email: '',
    status: {},
    avatar: {},
    name: {}
};

const userInfoLocalStorage = JSON.parse(localStorage.getItem('userInfo')) || {}

const getUserInfo = () => {
    const userInfo = {}

    // Update property in user
    Object.keys(userDefaults).forEach((key) => {
        // If property is defined in localStorage => Use that
        userInfo[key] = userInfoLocalStorage[key] ? userInfoLocalStorage[key] : userDefaults[key]
    })

    // Include properties from localStorage
    Object.keys(userInfoLocalStorage).forEach((key) => {
        if (userInfo[key] === undefined && userInfoLocalStorage[key] !== null) userInfo[key] = userInfoLocalStorage[key]
    })

    return userInfo
}

// Check if device is touch device
// This is used to remove perfect scrollbar from touch devices
// Using Dynamic components
const is_touch_device = () => {
    var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
    var mq = function (query) {
        return window.matchMedia(query).matches;
    }

    if (('ontouchstart' in window) || window.DocumentTouch) {
        return true;
    }

    // include the 'heartz' as a way to have a non matching MQ to help terminate the join
    // https://git.io/vznFH
    var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
    return mq(query);
}

let appParams = window.appParams;
const storageLocale = localStorage.getItem('purrLocale') || null;
if (!!appParams.locale && !storageLocale) {
    localStorage.setItem('purrLocale', appParams.locale);
}

// /////////////////////////////////////////////
// State
// /////////////////////////////////////////////

const state = {
    //AppActiveUser           : userDefaults,
    //AppActiveUser           : {id: null},
    AppActiveUser: getUserInfo(),
    bodyOverlay: false,
    isVerticalNavMenuActive: true,
    is_touch_device: is_touch_device(),
    mainLayoutType: themeConfig.mainLayoutType || "vertical",
    navbarSearchAndPinList: navbarSearchAndPinList,
    reduceButton: themeConfig.sidebarCollapsed,
    verticalNavMenuWidth: "default",
    verticalNavMenuItemsMin: false,
    scrollY: 0,
    starredPages: navbarSearchAndPinList["pages"].data.filter((page) => page.is_bookmarked),
    theme: themeConfig.theme || "light",
    themePrimaryColor: colors.primary,

    // Can be used to get current window with
    // Note: Above breakpoint state is for internal use of sidebar & navbar component
    windowWidth: null,
    appParams: window.appParams,

    petModalOpened: undefined,
    petCreateModalOpened: false
};

export default state
