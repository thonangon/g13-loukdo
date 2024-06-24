<template>
    <div class="container">
      <nav-bar/> 
      <login />
    </div>

</template>

<script>
// import navbar from "@/components/navbars/NavBar.vue"
import NavBar from './components/navbars/NavBar.vue'
import login from './components/login.vue'
export default {
  components:{
    NavBar,
    login
  }

}
</script>

<style>

</style>