import "./bootstrap"

import { createApp } from 'vue'
import stores from './stores'
import router from './router'

import App from './App.vue'

const app = createApp(App)

app.use(stores)
app.use(router)

app.mount('#app')
