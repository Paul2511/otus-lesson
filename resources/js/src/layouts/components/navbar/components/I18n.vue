<template>
    <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer mr-10">
        <span class="cursor-pointer flex items-center i18n-locale">
          <img class="h-4 w-5" :src="i18n_locale_img" :alt="$i18n.locale"/>
          <span class="hidden sm:block ml-2">{{ getCurrentLocaleData.lang }}</span>
        </span>
        <vs-dropdown-menu class="w-48 i18n-dropdown vx-navbar-dropdown">
            <vs-dropdown-item @click="updateLocale('ru')">
                <img class="h-4 w-5 mr-1" src="@assets/images/flags/ru.png" alt="ru"/> &nbsp;Русский
            </vs-dropdown-item>
            <vs-dropdown-item @click="updateLocale('en')">
                <img class="h-4 w-5 mr-1" src="@assets/images/flags/en.png" alt="en"/> &nbsp;English
            </vs-dropdown-item>
        </vs-dropdown-menu>
    </vs-dropdown>
</template>

<script>
    export default {
        computed: {
            i18n_locale_img() {
                // Use below code to dynamically fetch image instead of if-else
                // NOTE: We used if-else because laravel throws error in 'yarn prod'.
                // If you are not using laravel + Vue, you can use below code to dynamically get image
                // return require(`@/assets/images/flags/${this.$i18n.locale}.png`)

                const locale = this.$i18n.locale
                if (locale === 'en') return require('@assets/images/flags/en.png')
                else if (locale === 'ru') return require('@assets/images/flags/ru.png')
                else return require('@assets/images/flags/ru.png')
            },
            getCurrentLocaleData() {
                const locale = this.$i18n.locale
                if (locale === 'en') return {flag: 'us', lang: 'English'}
                else if (locale === 'ru') return {flag: 'ru', lang: 'Русский'}
            }
        },
        methods: {
            updateLocale(locale) {
                localStorage.setItem('purrLocale', locale);
                window.location.reload();
                //this.$i18n.locale = locale
            }
        }
    }
</script>