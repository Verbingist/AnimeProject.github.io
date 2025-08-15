import { createApp } from 'vue'
import App from './App.vue'
import 'normalize.css';
import './style.css'
import router from "./router/router"
import { createHead }  from '@vueuse/head'

createApp(App).use(router).use(createHead()).mount('#app')