<template>
  <section class="container">
    <b-carousel class="gap-3 d-flex" id="categoryCarousel" controls indicators background="#ababab">
      <b-carousel-slide v-for="category in categoriesWithProductCounts" :key="category.id">
        <router-link :to="{ name: 'product/category', params: { id: category.id } }" class="card-link">
          <div class="card h-100">
            <div class="cate-container">
            <img :src="category.image" class="p-2 card-img-top " :alt="category.title" style="background-color: #FFFBF9;">
          </div>
            <div class="card-body">
              <h5 class="card-title">{{ category.category_name }}</h5>
              <p class="card-text">{{ category.productCount }} products</p>
            </div>
          </div>
        </router-link>
      </b-carousel-slide>
    </b-carousel>

    <div class="dropdown">
      <button class="text-black bg-white border-0 opacity-50 btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-expanded="false">
        Categories
      </button>
      <ul class="border-0 dropdown-menu dropdown-menu-scroll" aria-labelledby="dropdownMenuButton" style="  max-height: 45px; overflow-y: auto;">
        <li v-for="category in categories" :key="category.id">
          <a class="dropdown-item" href="#">{{ category.category_name }}</a>
        </li>
      </ul>
    </div>
    
  </section>
</template>

<script>
import api from "@/views/api";
import cards_product from '@/Components/Card/CardComponent.vue';
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'

export default {
  components: {
    name: 'TopCategories',
  },
  data() {
    return {
      categories: [],
      products: [],
      hoveredProducts: null,
      selectedCategoryProducts: null,
      category_name: '',
      cate_img: null,
      isEdit: false,
      currentCategory: null
    };
  },

  mounted() {
    this.fetchProductCategories();
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
      this.hoveredProducts = null;
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
    handleImageUpload(event) {
      this.cate_img = event.target.files[0];
      console.log("Uploaded image:", this.cate_img);
    },
  },
  computed: {
    categoriesWithProductCounts() {
      return this.categories.map(category => {
        const productCount = this.products.filter(product => product.category_id === category.id).length;
        return {
          ...category,
          productCount
        };
      });
    }
  }
};
</script>

<style scoped>
.card {
  overflow: hidden;
  border-radius: 10px;
  transition: transform 0.3s;
}

.card:hover {
  transform: scale(1.05);
}

.card img {
  height: 200px;
  object-fit: cover;
  border-radius: 10px 10px 0 0;
}

.card-link {
  text-decoration: none;
  color: inherit;
}

.card-link:hover {
  text-decoration: none;
  color: inherit;
}





/* .dropdown-menu-scroll {
  max-height: 200px; 
  overflow-y: scroll;
} */

/* Hide scrollbar for WebKit-based browsers (Chrome, Safari) */
.dropdown-menu-scroll::-webkit-scrollbar {
  width: 0; /* Remove scrollbar space */
  background: transparent; /* Optional: just in case there's still scrollbar visible */
}

/* Hide scrollbar for other browsers (Firefox, etc.) */
.dropdown-menu-scroll {
  -ms-overflow-style: none;  /* Internet Explorer 10+ */
  scrollbar-width: none;  /* Firefox */
}

.dropdown-menu-scroll:hover {
  overflow-y: auto;
}
</style>




