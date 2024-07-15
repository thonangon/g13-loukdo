<template>
  <table class="table table-dark table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col" style="width: 10%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user, list) in users" :key="user.id" class="text-center">
                <th  v-if="user.id !==1" scope="row">{{ list }}</th>
                <td  v-if="user.id !==1">{{user.name}}</td>
                <td  v-if="user.id !==1">{{ user.email }}</td>
                <td  v-if="user.id !==1" class="">
                    <button class="btn btn-danger mb-2">Block</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import api from "@/views/api"
export default {
    data(){
        return {
            users: []
        }
    },
    mounted(){
        this.listUsers()
    },
    methods:{
        async listUsers(){
            let response = await api.listUsers()
            this.users = response.data
            console.log(this.users)
        },
        blockUser(id){
            // Implement the logic to block the user with the given id
            // You can use the api.put method to make a PUT request to the '/users/{id}/block' endpoint
            // Example: api.put(`/users/${id}/block`)
        }
    }
}
</script>

<style>

</style>