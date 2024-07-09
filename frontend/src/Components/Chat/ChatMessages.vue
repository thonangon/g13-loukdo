<template>
    <div class="chat-messages">
      <div class="messages-list">
        <ul>
          <li v-for="message in messages" :key="message.id">
            <strong>{{ message.user.name }}:</strong> {{ message.message }}
          </li>
        </ul>
      </div>
      <div class="message-input">
        <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message">
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['roomId'],
    data() {
      return {
        messages: [],
        newMessage: ''
      };
    },
    created() {
      this.fetchMessages();
    },
    methods: {
      fetchMessages() {
        axios.get(`/api/message/chat/messages/${this.roomId}`)
          .then(response => {
            this.messages = response.data;
          });
      },
      sendMessage() {
        axios.post(`/api/message/chat/messages/${this.roomId}`, {
          message: this.newMessage
        })
        .then(response => {
          this.messages.unshift(response.data);
          this.newMessage = '';
        });
      }
    }
  };
  </script>
  
  <style>
  .chat-messages {
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  .messages-list {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
  }
  .messages-list ul {
    list-style: none;
    padding: 0;
  }
  .messages-list li {
    margin-bottom: 10px;
  }
  .message-input {
    padding: 20px;
    border-top: 1px solid #ddd;
  }
  .message-input input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  </style>
  