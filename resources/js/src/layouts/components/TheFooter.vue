<!-- =========================================================================================
    File Name: TheFooter.vue
    Description: Footer component
    Component Name: TheFooter
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <footer class="the-footer flex-wrap justify-between" :class="classes">
        <p>
            <span>{{ $t('main.copyright') }}</span>
        </p>
    </footer>
</template>

<script>
    export default {
        name: 'the-footer',
        props: {
            classes: {
                type: String
            }
        }
    }
</script>
