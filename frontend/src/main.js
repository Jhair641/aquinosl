import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'

// Importa vue-toastification y sus estilos
import Toast from "vue-toastification";
import 'vue-toastification/dist/index.css';

const options = {
    // Puedes configurar opciones globales aquí si lo deseas
  };

const app = createApp(App)
app.use(createPinia())
app.use(router)
app.use(CoreuiVue)
app.provide('icons', icons)
app.component('CIcon', CIcon)

// Usa vue-toastification
app.use(Toast, options);

app.mount('#app')
