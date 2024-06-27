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
import NavBar from '@/Components/navbars/NavBar.vue';
import Footer from '@/Components/footer/FooTer.vue';
import UserProfile from './views/profile/ProfileVue.vue'


export default {
  components:{
    NavBar,
    // card,
    Footer,
    UserProfile

   
  }

}
</script>
<style>
</style>