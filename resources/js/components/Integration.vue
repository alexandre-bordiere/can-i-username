<template>
  <div class="flex items-center justify-between p-4 shadow">
    <p>{{ props.integration }}</p>
    <span v-if="state !== null">
      <IntegrationIcon :state="state" />
    </span>
  </div>
</template>
<script setup>
  import axios from 'axios'
  import { inject, onMounted, ref } from 'vue'

  import IntegrationIcon from '~/js/components/IntegrationIcon'

  const eventBus = inject('eventBus')
  const props = defineProps({
    integration: {
      type: String,
      required: true
    }
  })
  const state = ref(null)

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
