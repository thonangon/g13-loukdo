<template>
  <div>
    <table class="table table-dark table-striped">
          <thead>
              <tr>
              <th scope="col">Id</th>
              <th scope="col">Product</th>
              <th scope="col">Quantities</th>
              <th scope="col">Order by</th>
              <th scope="col">Owners</th>
              <th scope="col">Totals</th>
              <th scope="col" style="width: 10%;">Status</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(data, list) in datas" :key="data.id">
              <th scope="row">{{ list + 1 }}</th>
              <td>{{ data.products[0].name}}</td>
              <td>{{ data.quantity }}</td>
              <td>{{ data.products[0].buyer.name }}</td>
              <td>{{ data.products[0].owner.name  }}</td>
              <td>${{ data.products[0].price * data.quantity }}</td>
              <td class="d-flex gap-2">
                  <!-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" :data-bs-target="'#' + product.id" data-bs-whatever="@mdo">Edit</button> -->
                  <button v-if="data.status == 0" class="btn btn-primary mb-2" @click="deleteProduct(product.id)">In order</button>
                  <button v-else-if="data.status == 1" class="btn btn-secondary mb-2" @click="deleteProduct(product.id)">In delivery</button>
                  <button v-else class="btn btn-success mb-2" @click="deleteProduct(product.id)">Finish</button>
              </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import api from "@/views/api"
export default {
    data(){
        return {
            datas: {},
            error: null,
            loading: true
        }
    },
    mounted(){
        this.orderAndseller();
    },
    methods: {
        async orderAndseller(){
        try{
            const response = await api.orderAndseller();
            this.datas = response.data.orderProducts;
            console.log(data)
        } catch(error){
            this.error = error.message;
        }
    }
    }
}
</script>

<style>

</style>