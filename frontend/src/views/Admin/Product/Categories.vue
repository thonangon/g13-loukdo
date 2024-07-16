<template>
    <div class="container">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#category" data-bs-whatever="@getbootstrap">New Category</button>
      <div class="category d-flex gap-2">
        <!-- Categories List -->
         <div class="list-cate" style="width: 40%;">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                    v-for="(category, index) in categories" 
                    :key="category.id" 
                    >
                    <th scope="row">{{ index + 1 }}</th>
                    <td
                      @mouseenter="showProducts(category.id)"  
                      @mouseleave="hideProducts()"          
                      @click="getProductCategory(category.id)" 
                      style="cursor: pointer;" 
                      >{{ category.category_name }}
                    </td>
                    <td class="d-flex gap-2">
                        <button class="btn btn-primary">Edit</button>
                        <button class="btn btn-danger" @click="deleteCategories(category.id)">Delete</button>
                    </td>
                    </tr>
                </tbody>
                </table>
         </div>
    
        <!-- Product Details -->
        <div class="productSide" style="width: 60%; overflow-y: auto;">
            <!-- Show products on hover -->
            <div v-if="hoveredProducts !== null && selectedCategoryProducts === null" class="d-flex justify-content-between flex-wrap">
                <div v-for="product in hoveredProducts" :key="product.id" style="width: 50%;">
                    <cards_product :product="product" />
                </div>
            </div>
    
            <!-- Show detailed product information on click -->
            <div v-if="selectedCategoryProducts !== null" class="d-flex justify-content-between flex-wrap scrollable-products">
                <div v-for="product in selectedCategoryProducts" :key="product.id" style="width: 50%;">
                     <cards_product :product="product"/>
                </div>
            </div>
            <div v-else-if="hoveredProducts === null" class="d-flex justify-content-between flex-wrap scrollable-products">
                <div v-for="product in products" :key="product.id" style="width: 50%;">
                     <cards_product :product="product"/>
                </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name your category:</label>
                            <input type="text" class="form-control" id="recipient-name" v-model="newCate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  @click="createCate">Create</button>
                </div>
                </div>
            </div>
        </div>
    </div>
  </template>
  
  <script>
  import api from "@/views/api";
  import cards_product from '@/Components/Card/CardComponent.vue';
  
  export default {
    components: {
      cards_product
    },
    data() {
      return {
        categories: [],
        hoveredProducts: null, // Products shown on hover
        selectedCategoryProducts: null, // Products for selected category
        newCate: null, //
        products:[]
      };
    },
    mounted() {
      this.fetchProductCategories();
      this.createCate();
      this.fetchProducts();
    },
    methods: {
      async fetchProductCategories() {
        try {
          const response = await api.listCategories();
          if (response.status === 200) {
            this.categories = response.data.data;
          } else {
            console.error("Error fetching categories: ", response);
          }
        } catch (error) {
          console.error("API error: ", error);
        }
      },
      async fetchProducts() {
        try {
          const response = await api.listProduct();
          if (response.data.status) {
            this.products = response.data.data;
          } else {
            console.error("Error fetching products: ", response.data.message);
          }
        } catch (error) {
          console.error("API error: ", error);
        }
      },
      async showProducts(categoryId) {
        try {
          const response = await api.productCategory(categoryId);
          if (response.status === 200) {
            this.hoveredProducts = response.data.data;
          } else {
            console.error("Error fetching products: ", response);
          }
        } catch (error) {
          console.error("API error: ", error);
        }
      },
      hideProducts() {
        this.hoveredProducts = null; // Clear hovered products when mouse leaves
      },
      async getProductCategory(categoryId) {
        try {
          const response = await api.productCategory(categoryId);
          if (response.status === 200) {
            this.selectedCategoryProducts = response.data.data;
            if (!this.selectedCategoryProducts || this.selectedCategoryProducts.length === 0) {
              alert("No products found for this category!");
            }
          } else {
            console.error("Error fetching products: ", response);
          }
        } catch (error) {
          console.error("API error: ", error);
        }
      },
      async createCate() {
            // Prepare the data to send to the API
            const data = {
                category_name: this.newCate // Assuming your API expects the category name under 'name'
                // Add more fields if needed
            };
            console.log(data);
            try {
                // Call the API to create the category
                const response = await api.createCategory(data);
                if (response) {
                    // If the API call is successful, update the categories list
                    this.fetchProductCategories();
                    alert("Category created successfully!");
                    window.location.reload();
                }else {
                    console.error("Error creating category: ", response);
                    alert("Failed to create category. Please try again.");
                }
            } catch (error) {
                console.error("API error: ", error);
                // Handle network errors, API exceptions, etc.
            }

            // Reset the input field after processing
            this.newCate = '';
        },
        async deleteCategories(cateId){
          try {
            const response = await api.deleteCategory(cateId);
            if (response) {
              this.fetchProductCategories();
              alert("Category deleted successfully!");
              window.location.reload();
            } else {
              console.error("Error deleting category: ", response);
              alert("Failed to delete category. Please try again.");
            }
          } catch (error) {
            console.error("API error: ", error);
            // Handle network errors, API exceptions, etc.
          }
        }
    }
  };
  </script>
  
  <style>
  /* Add your custom styles here */
  .scrollable-products {
        max-height: 80vh; /* Adjust max-height as per your requirement */
        overflow-y: auto;
    }
  </style>
  