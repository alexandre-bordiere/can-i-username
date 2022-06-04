import mitt from 'mitt'
import { createApp } from 'vue'

import IntegrationsList from '~/js/components/integrations/IntegrationsList'
import UsernameForm from '~/js/components/UsernameForm'

const app = createApp()

app.component('integrations-list', IntegrationsList)
app.component('username-form', UsernameForm)
app.provide('eventBus', mitt())
app.mount('#app')
