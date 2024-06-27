<template>
    <product_slide/>
    <h2 class="text-center mb-4">Welcome to loukdo store</h2>
    <search_product/>
    <P class="text-center mb-4">Enjoy finding a million products all over the world here! <P class="text-center mb-4">All in ONE!</P></P>
    <cards_product/>
</template>

<script>
import cards_product from '@/Components/Card/CardComponent.vue'
import product_slide from '@/Components/Card/ProductSlide.vue'
import search_product from '@/Components/Search/SearchProduct.vue'
export default {
    components: {
        cards_product,
        product_slide,
        search_product,
    },
    data() {
        return {

        }
    }

}
</script>

<style>

</style>