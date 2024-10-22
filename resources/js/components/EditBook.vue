<template>
    <div>
        <h3 class="text-center">Edit Book</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="book.name">
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" v-model="book.author">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
// import http from "./http-common";
    export default {
        data() {
            return {
                book: {},
            }
        },
        
        created: function() {
    axios
      .get("http://localhost:8000/api/book/edit/${this.$route.params.id}")
      .then(res => {
        this.books = res.data;
      })
  },
        methods: {
            
           
updateBook(){
    const url = `http://localhost:8000/api/book/update/${this.$route.params.id}`;
    
    axios.post(url, this.book)
    .then((response) => {
                        this.$router.push({name: 'home'});
                    })
      .catch(error => {
        console.error(error);
      });
            }
        }}
  
        
        
    
</script>