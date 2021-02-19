<template>
    <div class="min-h-screen flex w-full bg-img">
        <div class="vx-col flex items-center justify-center flex-col sm:w-1/2 md:w-3/5 lg:w-3/4 xl:w-1/2 mx-auto text-center">
            <img src="@assets/images/pages/welcome.png" alt="graphic-welcome" class="mx-auto mb-4 max-w-full px-1 py-5">
            <h1 class="sm:mx-0 mx-4 mt-4 mb-12 text-5xl d-theme-heading-color">{{ $t('siteClose') }}</h1>
            <vs-button size="large" @click="$router.push('login')">{{ $t('loginClient') }}</vs-button>
        </div>
    </div>
</template>


