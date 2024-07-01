<template>
    <div>
      <!-- Your existing HTML template -->
      <div class="score" style="height: 200px;">
        <div class="rate d-flex">
          <h1>4.5</h1><h4>/9</h4>
        </div>
        <div class="star d-flex">
          <img src="../../assets/images/star.png" alt="">
          <img src="../../assets/images/star.png" alt="">
          <img src="../../assets/images/star.png" alt="">
          <img src="../../assets/images/star.png" alt="">
          <img src="../../assets/images/star.png" alt="">
        </div>
        <p>5000 score</p>
      </div>
      <div class="rateObtion d-flex justify-content-end border-top border-bottom">
        <div class="feadback d-flex">
          <button type="button" class="btn btn-outline-none border-start" data-bs-toggle="modal" data-bs-target="#feadback" data-bs-whatever="@fat">Feedback</button>
  
          <div class="modal fade" id="feadback" tabindex="-1" aria-labelledby="feadbackLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="feadbackLabel">Feedback for this product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form @submit.prevent="submitFeedback">
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Photo:</label>
                      <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04" @change="handleFileUpload">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Message:</label>
                      <textarea class="form-control" id="message-text" v-model="message"></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="star d-flex">
          <button class="btn btn-outline-none border-start dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../assets/images/star.png" alt="">Rate
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">5 Star</a></li>
            <li><a class="dropdown-item" href="#">4 Star</a></li>
            <li><a class="dropdown-item" href="#">3 Star</a></li>
            <li><a class="dropdown-item" href="#">2 Star</a></li>
            <li><a class="dropdown-item" href="#">1 Star</a></li>
          </ul>
        </div>
      </div>
  
      <!-- Display comments -->
      <div v-if="comments.length > 0">
        <h3>Comments:</h3>
        <ul>
          <li v-for="comment in comments" :key="comment.id">
            {{ comment.message }}
          </li>
        </ul>
      </div>
      <div v-else>
        <p>No comments yet.</p>
      </div>
    </div>
  </template>
  
  <script>
  import api from '../../views/api';
  import { useUserStore } from '@/stores/user.js';
  
  export default {
    props: ['product_id'],
    data() {
      return {
        message: '',
        selectedFile: null,
        user_store: useUserStore(),
        comments: [] // Initialize comments array
      };
    },
    methods: {
      handleFileUpload(event) {
        this.selectedFile = event.target.files[0];
      },
      async submitFeedback() {
        if (this.selectedFile && this.message) {
          const userToken = this.user_store.tokenUser;
  
          const formData = new FormData();
          formData.append('product_id', this.product_id);
          formData.append('comment', this.message);
          formData.append('image', this.selectedFile);
  
          try {
            const headers = {
              Authorization: `Bearer ${userToken}`,
              'Content-Type': 'multipart/form-data'
            };
  
            const response = await api.comment_product(formData, headers);
  
            console.log('Feedback submitted successfully:', response.data);
  
            // Clear form fields
            this.message = '';
            this.selectedFile = null;
  
            // Refresh comments
            await this.fetchComments(); // Assuming you have a method to fetch comments
          } catch (error) {
            console.error('Error submitting feedback:', error);
          }
        } else {
          alert('Please fill in all fields.');
        }
      },
     
    },
    mounted() {
      // Initial fetch of comments when component mounts
      this.submitFeedback();
    }
  };
  </script>
  
  <style>
  /* Your CSS styles */
  </style>
  