import mitt from 'mitt'
import { createApp } from 'vue'

import App from '~/js/components/App'

const app = createApp(App)

app.provide('eventBus', mitt())
app.mount('#app')
