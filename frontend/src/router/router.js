import { createRouter, createWebHistory } from "vue-router";
import AnimeList from "../views/AnimeList.vue";
import AboutInfo from "../views/AboutInfo.vue";
import Add from "../views/Add.vue";
import Author from "../views/Author.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Remove from "../views/Remove.vue";
import Update from "../views/Update.vue";
import UserList from "../views/UserList.vue";

const routes = [
    { path: "/", component: AnimeList },
    { path: "/AboutInfo", component: AboutInfo },
    { path: "/Add", component: Add },
    { path: "/Author", component: Author },
    { path: "/Login", component: Login },
    { path: "/Register", component: Register },
    { path: "/Remove", component: Remove },
    { path: "/Update", component: Update },
    { path: "/UserList", component: UserList },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router;