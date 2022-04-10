import '@/style/main.scss'
import {createApp} from 'vue'
import App from './App.vue'
import {createHead} from '@vueuse/head'
import { key, store } from '@/store'
import router from '@/router'
import './modules/shared/services/fetcher'
const head = createHead()
const app = createApp(App)

app.use(store, key)
app.use(router)
app.use(head)

app.mount('#app')

