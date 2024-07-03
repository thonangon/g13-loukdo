<template>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="input-group">
                    <input type="text" v-model="searchQuery" @input="onSearch" class="form-control " name="q" placeholder="Search ..." aria-label="Search Google">
                    <button class="btn btn-primary rounded-pill-end" type="button">Search</button>
                </form>
            </div>
        </div>
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
