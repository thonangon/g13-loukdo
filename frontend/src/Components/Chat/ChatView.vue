<template>
    <div class="chat-container">
      <div class="rooms-list">
        <ChatRooms @select-room="selectRoom" />
      </div>
      <div class="messages-view">
        <ChatMessages :roomId="selectedRoomId" v-if="selectedRoomId" />
        <div v-else class="no-room-selected">Select a room to start chatting</div>
      </div>
    </div>
  </template>
  
  <script>
  import ChatRooms from './ChatRooms.vue';
  import ChatMessages from './ChatMessages.vue';
  
  export default {
    components: {
      ChatRooms,
      ChatMessages
    },
    data() {
      return {
        selectedRoomId: null
      };
    },
    methods: {
      selectRoom(roomId) {
        this.selectedRoomId = roomId;
      }
    }
  };
  </script>
  
  <style>
  .chat-container {
    display: flex;
    height: 100vh;
  }
  .rooms-list {
    width: 30%;
    border-right: 1px solid #ddd;
    overflow-y: auto;
  }
  .messages-view {
    width: 70%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .no-room-selected {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    font-size: 18px;
    color: #777;
  }
  </style>
  