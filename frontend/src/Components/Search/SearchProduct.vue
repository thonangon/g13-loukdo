<template>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="input-group">
                    <input type="text" v-model="searchQuery" @input="onSearch" class="form-control rounded-pill" name="q" placeholder="Search Google..." aria-label="Search Google">
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
</style>
