<template>
  <div class="container">
    <header class="jumbotron jumbotron-fluid text-center p-5">
      <div class="container">
        <div class="d-flex align-items-center justify-content-center gap-5 font-size-5">
          <a href="#"><Table>TOP |</Table></a>
          <a href="#"><Table>BOTTOM |</Table></a>
          <a href="#"><Table>SELE...</Table></a>
        </div>
      </div>
    </header>
    <CardComponent></CardComponent>
  </div>
</template>

<script >
  import CardComponent from './components/Card/CardComponent.vue'
  export default ({
    name: 'HomeView',
    components: {
      CardComponent
    },
    data() {
      return {
        products :[
          {
            id: 1,
            name:'thonal',
            title: 'Example Clothing',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 2,
            name:'thonal',
            title: 'Example Clothing',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 3,
            name:'thonal',
            title: 'Example Clothing',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          },
          {
            id: 4,
            name:'thonal',
            title: 'Example Clothing',
            image: 'https://images.nightcafe.studio/jobs/8gONOFn1ruXBxrx9Jsc3/8gONOFn1ruXBxrx9Jsc3--1--9m9d2_2x.jpg?tr=w-1600,c-at_max'
          }
        ]
      }
    }
  });
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
