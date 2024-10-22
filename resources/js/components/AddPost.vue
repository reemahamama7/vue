<template>
    <h1>select user</h1>
    <div>
      <select v-model="selectedAuthor" @change="fetchPosts"  class="form-control mb-5">
        <option v-for="user in users" :key="user.id" :value="user.id">
          {{ user.name }}
        </option>
      </select>
  
      <div v-if="posts.length">
        <h3>Posts by {{ selectedAuthorName }}</h3>
    
        <table class="table table-striped mt-4">
      <thead>
        <tr>
          <th>Title</th>
          <th>Content</th>
        
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts" :key="post.id">
          <td>{{ post.title }}</td>
          <td>{{ post.content }}</td>
         
        </tr>
      </tbody>
    </table>
      </div>
  
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users: [],
        selectedAuthor: null,
        posts: []
      };
    },
    computed: {
      selectedAuthorName() {
        return this.users.find(user => user.id === this.selectedAuthor)?.name || 'Unknown';
      }
    },
    methods: {
      fetchAuthors() {
        axios.get('/api/authors')
          .then(response => {
            this.users = response.data;
          });
      },
      fetchPosts() {
        if (this.selectedAuthor) {
          axios.get(`/api/posts/author/${this.selectedAuthor}`)
            .then(response => {
              this.posts = response.data;
            });
        }
      }
    },
    mounted() {
      this.fetchAuthors();
    }
  };
  </script>
  