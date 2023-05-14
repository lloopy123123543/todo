<script setup>
import Nav from './components/Nav.vue'
import Login from './components/Login.vue'
import Footer from './components/Footer.vue'
</script>

<template>
    <div class="w-full">
        <Nav></Nav>
        <router-view></router-view>
        <Footer></Footer>
    </div>
</template>

<style scoped>

</style>
