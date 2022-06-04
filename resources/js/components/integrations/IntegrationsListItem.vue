<template>
  <div class="bg-gray-800 flex items-center justify-between p-4 rounded text-white">
    <p>{{ capitalize(props.integration) }}</p>
    <span v-if="state !== null">
      <IntegrationsListItemIcon :state="state" />
    </span>
  </div>
</template>
<script setup>
  import axios from 'axios'
  import { inject, onMounted, ref } from 'vue'

  import IntegrationsListItemIcon from '~/js/components/integrations/IntegrationsListItemIcon'
  import { useStringHelpers } from '~/js/composables/useStringHelpers'

  const eventBus = inject('eventBus')
  const props = defineProps({
    integration: {
      type: String,
      required: true
    }
  })
  const state = ref(null)
  const { capitalize } = useStringHelpers()

  onMounted(() => {
    eventBus.on('onFormSubmit', async ({ username }) => {
      try {
        state.value = 'loading'

        await axios.get(`/integrations/${props.integration}/is-username-available`, {
          params: { username },
        })

        state.value = 'success'
      } catch (e) {
        state.value = 'error'
      }
    })
  })
</script>
