import { createApp } from 'vue'
import App from './App.vue'
import 'normalize.css';
import './style.css'
import router from "./router/router"

createApp(App).use(router).mount('#app')