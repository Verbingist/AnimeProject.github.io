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
import Logout from "../views/Logout.vue";

const routes = [
    { path: "/", component: AnimeList, meta: { title: 'AnimeList' } },
    { path: "/AboutInfo", component: AboutInfo,  meta: { title: 'AboutInfo' } },
    { path: "/Add", component: Add,  meta: { title: 'Add Anime' }  },
    { path: "/Author", component: Author, meta: { title: 'Author' }  },
    { path: "/Login", component: Login, meta: { title: 'Login' }  },
    { path: "/Register", component: Register, meta: { title: 'Register' }  },
    { path: "/Remove", component: Remove, meta: { title: 'Remove Anime' }  },
    { path: "/Update", component: Update, meta: { title: 'Update Anime' }  },
    { path: "/UserList", component: UserList, meta: { title: 'UserList' }  },
    { path: "/Logout", component: Logout, meta: { title: 'UserList' } },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router;