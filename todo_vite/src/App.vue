<script setup>
import HelloWorld from './components/HelloWorld.vue'
import Header from './components/Header.vue'
</script>

<template>
  <div class="container">
    <Header></Header>
  </div>
  <HelloWorld msg="Coca cola is puma!" />
</template>

<style scoped>

.container {
  width: 100%;
  height: auto;
  background-color: red;
}
</style>
