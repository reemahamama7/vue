import "./bootstrap";
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";

import App from "./App.vue";
import AllBooks from "./components/AllBooks.vue";
import AddBook from "./components/AddBook.vue";
import EditBook from "./components/EditBook.vue";

import AddPost from "./components/AddPost.vue";
import Up from "./components/Up.vue";
import Post from "./components/Post.vue";
import CreateUsers from "./components/CreateUsers.vue";

// Define your routes
const routes = [
    {
        name: "home",
        path: "/",
        component: AllBooks,
    },
    {
        name: "add",
        path: "/add",
        component: AddBook,
    },
    {
        name: "edit",
        path: "/edit/:id",
        component: EditBook,
    },
    {
        name: "post",
        path: "/post",
        component: AddPost,
    },
    {
        name: "users-with-posts",
        path: "/users-with-posts",
        component: Up,
    },
    {
        name: "posts",
        path: "/posts",
        component: Post,
    },
    {
        name: "createusers",
        path: "/createusers",
        component: CreateUsers,
    },
];

// Create the router instance
const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Create and mount the root instance
createApp(App).use(router).mount("#app");
