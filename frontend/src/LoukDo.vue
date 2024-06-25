<template>
    <div class="container">
      <nav-bar/>
      <body>
        <router-view/>
      </body>
      <Footer/> 
      <UserProfile/>
    </div>

</template>

<script>  
// import navbar from "@/components/navbars/NavBar.vue"
import NavBar from '@/Components/navbars/NavBar.vue';
import Footer from '@/Components/footer/FooTer.vue';
import UserProfile from './views/profile/ProfileVue.vue'

export default {
  components:{
    NavBar,
    Footer,
    UserProfile

   
  }

}
</script>
<style>
</style>