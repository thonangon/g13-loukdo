<template>
    <div class="container">
      <nav-bar/>
      <Card></Card>
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
import Card from '@/Components/Card/CardComponent.vue';
export default {
  components:{
    NavBar,
    Footer,
    Card
  }

}
</script>

<style>

</style>