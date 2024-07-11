<template>
  <div class="">
    <search_product/>
    <div class="scrollable-container">
        <div class="row">
          <div class="col-md-3 mt-3" v-for="(product, index) in products" :key="index">
            <cards_product :searchQuery="searchQuery" :product="product" />
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import { useUserStore } from '../../stores/user'
import search_product from '@/Components/Search/SearchProduct.vue'
import api from '@/views/api'
import cards_product from '@/Components/Card/CardComponent.vue'
export default {
    props: ['id'],
    components: {
        search_product,
        cards_product
    },
    data(){
        return{
            cateId: useUserStore(),
            products: null,
        }
    },
    mounted(){
        this.getProductCategory();
    },
    watch:{
        id: {
            immediate: true,
            handler(newId) {
                this.getProductCategory(newId);
            }
        }
    },
    methods: {
        async getProductCategory(){
            const cate_id = this.id;
            try {
                const res = await api.productCategory(cate_id);
                if (res.status){
                    this.products = res.data.data;
                    if (this.products == null){
                        alert("No products found for product category here!"); 
                    }
                }
            } catch (error) {
                console.error(error);
            }
        }
    },
}
</script>

<style>

</style>