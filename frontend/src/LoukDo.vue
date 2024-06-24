<template>
    <div class="container">
      <nav-bar/>
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

export default {
  components:{
    NavBar,
    Footer,
  }

}
</script>

<style>

</style>