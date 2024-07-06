<template>
    <div class="chat-rooms">
      <h2>Chat Rooms</h2>
      <ul>
        <li v-for="room in rooms" :key="room.id" @click="selectRoom(room.id)">
          Room {{ room.id }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        rooms: []
      };
    },
    created() {
      this.fetchRooms();
    },
    methods: {
      fetchRooms() {
        axios.get('/api/message/chat/rooms')
          .then(response => {
            this.rooms = response.data;
          });
      },
      selectRoom(roomId) {
        this.$emit('select-room', roomId);
      }
    }
  };
  </script>
  
  <style>
  .chat-rooms {
    padding: 20px;
  }
  .chat-rooms ul {
    list-style: none;
    padding: 0;
  }
  .chat-rooms li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    cursor: pointer;
  }
  .chat-rooms li:hover {
    background-color: #f0f0f0;
  }
  </style>
  