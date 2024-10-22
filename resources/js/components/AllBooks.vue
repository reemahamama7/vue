<template>
    <div>
        <h3 class="text-center">All Books</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.name }}</td>
                <td>{{ book.author }}</td>
                <td>{{ book.created_at }}</td>
                <td>{{ book.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: book.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(book.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
    export default {
        data() {
            return {
                books: []
            }
        },
        created: function() {
    axios
      .get("http://localhost:8000/api/books")
      .then(res => {
        this.books = res.data;
      })
  },
        methods: {
           
            // deleteBook(id) {
                // this.axios
                //     .delete(`http://localhost:8000/api/books/delete/${id}`)
                //     .then(response => {
                //         let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                //         this.books.splice(i, 1)
                //     });
                
    //             const url = `http://localhost:8000/api/books/delete/${this.$route.params.id}`;
    
    // axios.delete(url, this.book)
    // .then((response) => {
    //         let i = this.books.map(item => item.id).indexOf(id); // find index of your object
    //         this.books.splice(i, 1)
    //                 })
    //   .catch(error => {
    //     console.error(error);
    //   });
    //
    

// }

deleteBook(id) {
      if (id) {
        const url = `http://localhost:8000/api/book/delete/${id}`;
        axios.delete(url, this.book)
        .then(response => {
                   let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                      this.books.splice(i, 1)
                 })
      .catch(error => {
        console.error(error);
      });
    //     fetch(url, {
    //       method: 'DELETE',
    //     })
    //       .then(response => {
    //         if (response.ok) {
    //           // Handle success (e.g., remove the book from the list)
    //           this.books = this.books.filter(book => book.id !== id);
    //         } else {
    //           console.error('Failed to delete the book');
    //         }
    //       })
    //       .catch(error => console.error('Error:', error));
    //   } else {
    //     console.error('Book ID is undefined');
      }
}}}
 
        

</script>