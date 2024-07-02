<template>
    <div>

        <div class="d-flex align-items-center" style="height: 60px;">
            <!-- <img src="../../assets/images/Male User.png" alt="User Image" style="height: 50px; width: 43px; margin-right: 10px;"> -->
            <p class="mb-0">{{ comment.user.name }}:</p>
        </div>
        <div class="d-flex flex-column">
            <p>{{ comment.comment }}.</p>
            <p class="d-flex">
                <img :src="imageCommented_url(comment.image)" alt="Comment Image" style="width: 243px; height: 240px;">
                <small>Posted on: {{ new Date(comment.created_at).toLocaleString() }}</small>
            </p>
        </div>
        <div class="user-actions">
            <button class="btn btn-primary btn-custom">Like</button>
            <button class="btn btn-secondary">Reply</button>
        </div>
    </div>
</template>

<script>
import api from "@/views/api.js";
export default {
    props: ['comment'],

    methods:{
        imageCommented_url(filename){
            return api.imageComment(filename);
        },
    }
}
</script>

<style>

</style>