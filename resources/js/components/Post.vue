<template>
    <div>
      <h1>Create a Post</h1>
      <div class="row">
            <div class="col-md-6">
      <form @submit.prevent="createPost">
        <!-- User Dropdown -->
        <div class="form-group">
          <label for="user">Select User:</label>
          <select v-model="form.user_id"  class="form-control" required>
            <option v-for="user in users" :key="user.id" :value="user.id">
              {{ user.name }}
            </option>
          </select>
        </div>
  
        <!-- Post Title -->
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" v-model="form.title" required />
        </div>
  
        <!-- Post Content -->
        <div class="form-group">
          <label for="content">Content:</label>
          <textarea v-model="form.content" class="form-control" required></textarea>
        </div>
  
        <button type="submit"class="btn btn-primary">Create Post</button>
      </form>
      </div>
    </div>
      <!--  -->
    
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          user_id: '',  // Store selected user's id
          title: '',
          content: ''
        },
        users: []  // Array to hold users fetched from backend
      };
    },
    created() {
      this.fetchUsers();  // Fetch users when the component is created
    },
    methods: {
      async fetchUsers() {
        try {
          const response = await axios.get('/api/users');
          this.users = response.data;  // Populate users array with data from backend
        } catch (error) {
          console.error('Error fetching users:', error);
        }
      },
      async createPost() {
        try {
          const response = await axios.post('/api/posts', {
            user_id: this.form.user_id,  // Send selected user's id
            title: this.form.title,
            content: this.form.content
          });
          alert('Post created successfully!');
        } catch (error) {
          console.error('Error creating post:', error);
        }
      }
    }
  };
  </script>
  