<template>
  <div>
    <table class="table table-dark table-striped">
      <thead>
        <tr class="text-center">
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th> <!-- Update the table header to display "Creator Name" -->
          <th scope="col" style="width: 10%;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in usersstore" :key="user.id" class="text-center">
          <td>{{ }}</td>
          <td>{{ }}</td> <!-- Display the store name -->
          <td>{{ }}</td> <!-- Display the creator's name here -->
          <td>
            <button class="btn btn-danger mb-2">Block</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

</script>
