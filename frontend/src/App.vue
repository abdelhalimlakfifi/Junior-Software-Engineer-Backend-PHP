<script setup>
import HelloWorld from './components/HelloWorld.vue';
import Header from './components/Header.vue';
</script>

<template>
    <div class=" m-10">
        <Router-link to="/">
            <Header />
        </Router-link>
    </div>

    <div class="w-full flex justify-center">
        <div class=" w-full max-w-sm mx-10 md:max-w-4xl">
            <router-view></router-view>
        </div>
    </div>

</template>

<style scoped>

</style>