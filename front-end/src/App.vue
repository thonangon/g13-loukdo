<template>
  <div>
    <!-- <NavBars></NavBars> -->
    <LoukDo></LoukDo>
  </div>
</template>

<script>
import LoukDo from './views/LoukDo.vue'

export default {
  name: 'App',
  components: {
    LoukDo
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
