import axios from 'axios'
import { onMounted, ref } from 'vue'

export function useIntegrations() {
  const integrations = ref([])

  onMounted(async () => {
    integrations.value = (await axios.get('/integrations')).data
  })

  return { integrations }
}
