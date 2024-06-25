<template>
    <div class="container">
      <nav-bar/>
      <Profile/>
      <body>
        <router-view/>
      </body>
      <Footer/> 
    </div>
</template>

<script>
// import navbar from "@/components/navbars/NavBar.vue"
import NavBar from '@/Components/navbars/NavBar.vue';
import Footer from '@/Components/footer/FooTer.vue';
import Profile from './views/profile/ProfileVue.vue';
export default {
  components:{
    NavBar,
    Profile,
    Footer,
  }

}
</script>

<style>

</style>