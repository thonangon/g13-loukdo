<template>
    <div class="container">
      <nav-bar/>
      <card></card>
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
import card from "@/Components/Card/CardComponent.vue"

export default {
  components:{
    NavBar,
    card,
    Footer,

   
  }

}
</script>
<style>
</style>