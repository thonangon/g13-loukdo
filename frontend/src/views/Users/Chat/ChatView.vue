<template>
    <div class="container-fluid p-0" style="height: 80vh;">
      <div class="row g-0" style="height: 100%">
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4 sidebar">
          <div class="d-flex flex-column h-100 bg-dark text-light">
            <!-- Search -->
            <div class="p-3">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <!-- Chat List -->
            <div class="chat-container flex-grow-1 overflow-auto p-3">
                <div v-for="(room, index) in chatRoomsData" :key="index" class="mb-3">
                    <div v-if="room">
                      <div v-if="room.sender.id !== store_user.accountUser.id" @click="getRoom(room)" class="chat-item d-flex align-items-center p-3 shadow-sm rounded bg-white">
                          <img :src="profileimage(room.sender.profile) || '../../../assets/images/Male User.png'" class="profile-img rounded-circle mr-3" alt="Avatar">
                          <div class="chat-info">
                              <h6 class="mb-0 font-weight-bold text-primary">{{ room.sender.name }}</h6>
                              <p v-if="room.newmessage" class="text-dark">{{ room.newmessage.message }}</p>
                              <p v-else class="text-dark">New...</p>
                          </div>
                      </div>
                      <div v-else @click="getRoom(room)" class="chat-item d-flex align-items-center p-1 shadow-sm rounded bg-white">
                          <img :src="profileimage(room.receiver.profile) || '../../../assets/images/Male User.png'" class="profile-img rounded-circle mr-3" alt="Avatar">
                          <div class="chat-info">
                              <h6 class="mb-0 font-weight-bold text-primary">{{ room.receiver.name }}</h6>
                              <p v-if="room.newmessage" class="text-dark">{{ room.newmessage.message }}</p>
                              <p v-else class="text-dark">New...</p>
                          </div>
                      </div>
                    </div>
                  </div>
            </div>

            <!-- Footer -->
            <div class="p-3 text-center">
              <button class="btn btn-primary">New Chat</button>
            </div>
          </div>
        </div>
  
        <!-- Chat Area -->
        <div class="col-lg-9 col-md-8 chat-area">
          <div class="chat-header p-3 bg-secondary">
            <h4 class="m-0">Chat Title</h4>
          </div>
          <div class="chat-messages flex-grow-1 overflow-auto p-3">
            <div class="message-item">
              <div class="message-right">
                <p>Message 1</p>
              </div>
              <div class="message-left">
                <p>Message 2</p>
                {{ eachRoom }}
              </div>
            </div>
          </div>
          <div class="chat-input p-3 d-flex">
            <input type="text" class="form-control" placeholder="Type your message">
            <button class="btn btn-primary">Send</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { useUserStore } from '@/stores/user';
  import api from '@/views/api';

  export default {
    data() {
      return {
        store_user: useUserStore(),
        chatRoomsData: null,  // Variable to store the chat rooms data
        eachRoom: null // Variable to store the
      };
    },
    async mounted() {  // Using mounted hook to call the method when the component is mounted
      await this.getChatRooms();
      await this.createChatRoom()

    },
    methods: {
      async createChatRoom() {
        const user_id = this.store_user.user_id; // Ensure store_user is defined and accessible
        const auth = this.store_user.tokenUser; // Ensure tokenUser contains the correct token
        console.log(user_id, auth);
        const header = {
          'Authorization': `Bearer ${auth}`,
          'Content-Type': 'application/json',
        }
        try {
          const response = await api.createChatRoom(user_id, header);
          window.location.href = '/chats'
        } catch (error) {
          console.error(error);
        }
      },
      async getChatRooms() {
        try {
          const user_token = this.store_user.tokenUser;
          const headers = {
            'Authorization': `Bearer ${user_token}`,
            'Content-Type': 'application/json',
          };
          const response = await api.chatrooms(headers);
          console.log(response.data.data);
          this.chatRoomsData = response.data.data;
        } catch (error) {
          console.error(error);
        }
      },
      async getRoom(room){
        // this.eachRoom = room.newmessage.chat_room_id;  // Assign the room to eachRoom variable
        const room_id = room.newmessage.chat_room_id;

        if (room_id){
          try{
            const user_token = this.store_user.tokenUser;
            const headers = {
              'Authorization': `Bearer ${user_token}`,
              'Content-Type': 'application/json',
            };
            const response = await api.getMessage(room_id, headers);
            this.eachRoom = response.data.data;
            console.log(response.data.data);
            // this.chatMessages = response.data.data; // Update chat messages in the chat area
          }catch(e) {
            console.error(e);
          }
        }
        
      },
      user_id(){
        return this.store_user.tokenUser;
      },

      profileimage(filename){
        return api.profile(filename)
      }
    },
  };


  </script>
  
  <style scoped>
  .circular {
    width: 50px; /* Adjust as needed */
    height: 50px; /* Adjust as needed */
    border-radius: 50%;
    overflow: hidden;
  }

  /* .chat-container {
    background-color: #f0f2f5;
    border-radius: 10px;
    padding: 20px;
    overflow-y: auto;
    height: 100%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
} */

.chat-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
}

.chat-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

.profile-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #007bff;
}

.chat-info h6 {
    margin-bottom: 5px;
    font-size: 1rem;
    color: #333;
}

.chat-info p {
    margin-bottom: 0;
    font-size: 0.9rem;
    color: #6c757d;
}

.text-primary {
    color: #007bff !important;
}

.text-muted {
    color: #6c757d !important;
}

.flex-grow-1 {
    flex-grow: 1;
}

.overflow-auto {
    overflow: auto;
}

.p-4 {
    padding: 1.5rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.mr-3 {
    margin-right: 1rem !important;
}
  </style>
  