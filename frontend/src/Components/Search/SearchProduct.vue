<template>
    <div class="container mt-4 mb-4">
        <h2 class="text-center mb-4">Welcome to Loukdo Store</h2>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="input-group">
                    <input type="text" v-model="searchQuery" @input="onSearch" class="form-control " name="q" placeholder="Search ..." aria-label="Search Google">
                    <button class="btn btn-primary rounded-pill-end" type="button">Search</button>
                </form>
            </div>
        </div>
        <p class="text-center mb-4">Enjoy finding a million products all over the world here!</p>
        <p class="text-center mb-4">All in ONE!</p>
    </div>
</template>

<script>
export default {
    name: 'SearchProduct',
    data() {
        return {
            searchQuery: ''
        }
    },
    methods: {
        onSearch() {
            this.$emit('search', this.searchQuery);
        }
    }
}
</script>

<style>
/* Add any custom styles here */
    .input-group{
        position: relative;
    }
    .input-group .form-control{
        border-top-right-radius: 0;
         border-bottom-right-radius: 0;
    }
    .input-group .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
