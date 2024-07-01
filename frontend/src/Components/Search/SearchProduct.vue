<template>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="https://www.google.com/search" method="GET" target="_blank" class="input-group">
                    <input type="text" class="form-control rounded-pill" name="q" placeholder="Search Google..." aria-label="Search Google">
                    <button class="btn btn-primary rounded-pill" type="submit">
                        Loukdo
                    </button>
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
