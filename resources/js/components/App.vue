<template>
  <main
    id="app"
    class="p-4 space-y-8"
  >
    <section>
      <form @submit.prevent="onSubmit">
        <input
          v-model="username"
          type="text"
          class="w-full"
          placeholder="Username"
          required
        >
      </form>
    </section>
    <section>
      <Integration
        v-for="integration in integrations"
        :key="integration"
        :integration="integration"
      />
    </section>
  </main>
</template>
<script setup>
  import { inject, ref } from 'vue'

  import { useIntegrations } from '~/js/composables/useIntegrations'
  import Integration from '~/js/components/Integration'

  const eventBus = inject('eventBus')
  const username = ref('')
  const { integrations } = useIntegrations()

  function onSubmit() {
    eventBus.emit('onFormSubmit', { username: username.value })
  }
</script>
