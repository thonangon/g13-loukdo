<template>
  <div class="d-flex align-items-center mb-3">
    <img src="../../assets/images/Male User.png" alt="User Image" class="mr-3" style="height: 50px; width: 43px;">
    <p class="mb-0">{{ comment.user.name }}: {{ new Date(comment.created_at).toLocaleString() }}</p>
  </div>
  <div class="d-flex flex-column">
    <p>{{ comment.comment }}.</p>
    <div class="d-flex">
      <img :src="imageCommented_url(comment.image)" alt="Comment Image" class="mr-3" style="width: 243px; height: 240px;">
    </div>
  </div>
  <div class="user-actions">
    <button class="btn btn-primary btn-custom me-2" @click="toggleLike">
      <span v-if="isLiked">👍 {{ likeCount }}</span>
      <span v-else>Like</span>
    </button>
    <button @click="toggleReply" class="btn btn-secondary me-2">
      <span v-if="showReplyForm">Reply</span>
      <span v-else>Reply</span>
    </button>
    <div v-if="showReplyForm" class="reply-form">
      <textarea v-model="Comment" placeholder="Enter your reply" class="form-control mb-2 w-50"></textarea>
      <button @click.prevent="submitReply" class="btn btn-primary">Send</button>
    </div>
    <div class="mt-3">
      <span>{{comment.user.name}} reply:</span>
    </div>
  </div>
</template>

<script>
import api from "../../views/api.js";
import { useUserStore } from '@/stores/user.js';

export default {
  props: ['comment'],
  data() {
    return {
      showReplyForm: false,
      Comment: null,
      store_user: useUserStore(),
      isLiked: false,
      likeCount: 0,
    }
  },
  created() {
    this.loadLikeStatus();
  },
  methods: {
    imageCommented_url(filename) {
      return api.imageComment(filename);
    },
    async submitReply() {
  try {
    if (this.Comment !== null && this.Comment.trim() !== '') {
      const formData = new FormData();
      formData.append('text', this.Comment);
      formData.append('user_id', this.store_user.accountUser.id);
      formData.append('comment_id', this.comment.id);

      const token = localStorage.getItem('authToken');
      const response = await api.replycomment(formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${this.store_user.tokenUser}`
        }
      });
      console.log('reply created:', response.data);
      this.showReplyForm = false;
      this.Comment = null;
    } else {
      // Do not save the reply to the database if the Comment text is null or empty
      console.log('Cannot submit an empty reply');
    }
  } catch (error) {
    console.error('Error submitting reply:', error);
  }
    },
    toggleLike() {
      this.isLiked = !this.isLiked;
      if (this.isLiked) {
        this.likeCount++;
      } else {
        this.likeCount--;
      }
      this.saveLikeStatus();
    },
    saveLikeStatus() {
      const likeKey = `comment-${this.comment.id}-like`;
      localStorage.setItem(likeKey, JSON.stringify({
        isLiked: this.isLiked,
        likeCount: this.likeCount
      }));
    },
    loadLikeStatus() {
      const likeKey = `comment-${this.comment.id}-like`;
      const likeData = JSON.parse(localStorage.getItem(likeKey));
      if (likeData) {
        this.isLiked = likeData.isLiked;
        this.likeCount = likeData.likeCount;
      }
    },
    toggleReply(){
       this.showReplyForm = !this.showReplyForm;
    },
  }
}
</script>

<style>
.reply-form {
  margin-top: 1rem;
}
</style>