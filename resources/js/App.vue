<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <!-- <a href="https://shouts.dev/" target="_blank"><img src="https://i.imgur.com/hHZjfUq.png"></a><br> -->
            <span class="text-secondary">Laravel & Vue CRUD Single Page Application (SPA) Tutorial</span>
        </div>

        <nav class="">
            <div class="">
                <div class="flex gap-4 container ">
                    <router-link to="/" class="btn btn-info">Home</router-link>
                    <router-link to="/add" class="btn btn-info">Add Book</router-link>
                    <router-link to="/createusers" class="btn btn-info">Create Users</router-link>

                    <router-link to="/post" class="btn btn-info">Show post by user</router-link>
                    <router-link to="/users-with-posts" class="btn btn-info">Report</router-link>
                    <router-link to="/posts" class="btn btn-info"> Create new post</router-link>
                    


                </div>
            </div>
        </nav>
        
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>