<template>
    <div class="container mt-5">
      <h3>Create New User</h3>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" v-model="user.name" class="form-control" id="name" placeholder="Enter name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" v-model="user.email" class="form-control" id="email" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" v-model="user.password" class="form-control" id="password" placeholder="Enter password" required>
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input type="password" v-model="user.password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" required>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
      </form>
  
      <div v-if="message" class="alert alert-success mt-3">
        {{ message }}
      </div>
      <div v-if="errors.length" class="alert alert-danger mt-3">
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: {
          name: '',
          email: '',
          password: '',
          password_confirmation: ''
        },
        message: '',
        errors: []
      };
    },
    methods: {
      // Submit form data to the backend
      submitForm() {
        axios.post('/api/users', this.user)
          .then(response => {
            this.message = response.data.message;
            this.errors = [];
            this.user = {
              name: '',
              email: '',
              password: '',
              password_confirmation: ''
            };
          })
          .catch(error => {
            if (error.response && error.response.data.errors) {
              this.errors = Object.values(error.response.data.errors).flat();
            }
          });
      }
    }
  };
  </script>
  
  <style scoped>
    .container {
      max-width: 600px;
    }
  </style>
  