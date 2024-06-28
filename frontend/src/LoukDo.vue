<template>
  <div>
    <nav-bar/>
    <div class="container">
      <router-view/>
    </div>
    <Footer/>
  </div>
</template>

<script>
import NavBar from '@/Components/navbars/NavBar.vue';
import Footer from '@/Components/footer/FooTer.vue';

export default {
  components: {
    NavBar,
    Footer,
  },
}
</script>

<style>
</style>
