<template>
  <nav-bar/>
    <div class="container">
      <body>
        <router-view/>
      </body>
    </div>
    <Footer/> 
</template>

<script>
import NavBar from '@/Components/navbars/NavBar.vue';
import Footer from '@/Components/footer/FooTer.vue';


export default {
  components:{
    NavBar,
    // card,
    Footer,
  }

}
</script>
<style>
</style>