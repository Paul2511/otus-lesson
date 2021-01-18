/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  Strucutre:
          url     => router path
          name    => name to display in sidebar
          slug    => router path name
          icon    => Feather Icon component/icon name
          tag     => text to display on badge
          tagColor  => class to apply on badge element
          i18n    => Internationalization
          submenu   => submenu of current item (current item will become dropdown )
                NOTE: Submenu don't have any icon(you can add icon if u want to display)
          isDisabled  => disable sidebar item/group
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default [
    // {
    //   url: "/apps/email",
    //   name: "Email",
    //   slug: "email",
    //   icon: "MailIcon",
    //   i18n: "Email",
    // },
    {
        url: "/cabinet",
        name: "Dashboard",
        slug: "home",
        icon: "HomeIcon",
        i18n: "Dashboard",
    },
    {
        url: "/cabinet/profile",
        name: "Profile",
        slug: "Profile",
        icon: "UserIcon",
        i18n: "Profile",
    },
    {
        url: "/cabinet/pets",
        name: "Pets",
        slug: "Pets",
        iconPack: "material-icons",
        icon: "pets",
        i18n: "myPets",
    },
    {
        url: "/cabinet/requests",
        name: "Requests",
        slug: "Requests",
        icon: "CalendarIcon",
        i18n: "myRequests"
    }
]