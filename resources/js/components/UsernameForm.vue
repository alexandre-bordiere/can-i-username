<template>
  <form @submit.prevent="onSubmit">
    <input
      v-model="username"
      type="text"
      class="block bg-gray-800 border-transparent placeholder-gray-300 rounded-md text-white w-full focus:border-blue-700"
      placeholder="Username"
      required
    >
  </form>
</template>
<script setup>
  import { inject, ref } from 'vue'

  const eventBus = inject('eventBus')
  const username = ref('')

  function onSubmit() {
    eventBus.emit('onFormSubmit', { username: username.value })
  }
</script>
