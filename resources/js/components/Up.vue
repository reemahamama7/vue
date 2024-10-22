<!-- 
   <template>
    <div class="container mt-5">
      <h3 class="mb-4">Users and their Posts</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Post Titles</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <ul v-for="post in user.posts" :key="post.id">
                <li >{{ post.title }}  <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(post.id)">Delete</button></li>
                        <button @click="printPosts(user)" class="btn btn-info btn-sm">Print Posts</button>
             
              </ul>
              
              
             
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users: []
      };
    },
    mounted() {
      this.fetchUsersWithPosts();
      
    },
    methods: {
      fetchUsersWithPosts() {
        axios.get('/api/users-with-posts')
          .then(response => {
            this.users = response.data;
          })
          .catch(error => {
            console.error("There was an error fetching the data!", error);
          });
    
},
printPosts(user) {
      const postTitles = user.posts.map(post => post.title).join('\n');
      const printWindow = window.open('', '_blank');
      printWindow.document.write(`<pre>Posts for ${user.name}:\n${postTitles}</pre>`);
      printWindow.document.close();
      printWindow.print();
          
    

}
  }
}
  </script>
   -->
   <template>
    <div class="container mt-5">
      <h3 class="mb-4">Users and their Posts</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Posts</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <ul>
                <li v-for="post in user.posts" :key="post.id" class="flex gap-3 mb-5">
                 <h3 class="w-[50%]"> {{ post.title }}</h3> 
                
                  <button @click="editPost(post)" class="btn btn-primary btn-sm">Edit</button>
                  <button @click="deletePost(post.id)" class="btn btn-danger btn-sm">Delete</button>
                  <button @click="printPost(user,post)" class="btn btn-info btn-sm">Print</button>
                </li>
              </ul>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Edit Post Modal -->
  <!-- Edit Post Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="postTitle" class="form-label">Post Title</label>
              <input v-model="editPostData.title" type="text" id="postTitle" class="form-control" placeholder="Enter Post Title">
            </div>
            <div class="mb-3">
              <label for="postContent" class="form-label">Post Content</label>
              <textarea v-model="editPostData.content" id="postContent" class="form-control" rows="4" placeholder="Enter Post Content"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="updatePost">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users: [],
        editPostData: {
          id: null,
          title: ''
        }
      };
    },
    mounted() {
      this.fetchUsersWithPosts();
    },
    methods: {
      fetchUsersWithPosts() {
        axios.get('/api/users-with-posts')
          .then(response => {
            this.users = response.data;
          })
          .catch(error => {
            console.error("Error fetching users with posts:", error);
          });
      },
      editPost(post) {
        this.editPostData = { ...post }; // Copy post data into editPostData
        new bootstrap.Modal(document.getElementById('editModal')).show();
      },
        // Update post (title and content)
    updatePost() {
      axios.put(`/api/posts/${this.editPostData.id}`, {
        title: this.editPostData.title,
        content: this.editPostData.content
      })
      .then(response => {
        this.fetchUsersWithPosts();  // Refresh the data
        new bootstrap.Modal(document.getElementById('editModal')).hide();
      })
      .catch(error => {
        console.error('Error updating post:', error);
      });
    },
      savePost() {
        axios.put(`/api/posts/${this.editPostData.id}`, { title: this.editPostData.title },{ content: this.editPostData.content })
          .then(() => {
            this.fetchUsersWithPosts(); // Refresh data
            new bootstrap.Modal(document.getElementById('editModal')).hide(); // Close modal
          })
          .catch(error => {
            console.error("Error updating post:", error);
          });
      },
      deletePost(id) {
        if (confirm("Are you sure you want to delete this post?")) {
          axios.delete(`/api/posts/${id}`)
            .then(() => {
              this.fetchUsersWithPosts(); // Refresh data
            })
            .catch(error => {
              console.error("Error deleting post:", error);
            });
        }
      },
      printPost(user,post) {
        const printWindow = window.open('', '_blank');
         printWindow.document.write(`<pre>Posted by ${user.name}</pre>`);
        printWindow.document.write(`<pre>Post Title: ${post.title}</pre>`);
        printWindow.document.write(`<pre>Post content: ${post.content}</pre>`);

        printWindow.document.close();
        printWindow.print();
      }
    }
  };
  </script>
  
  <style scoped>
  .modal-backdrop {
    z-index: 0;
  }
  </style>
  