<template>
  <CheckIcon v-if="props.state === 'success'" />
  <CrossIcon v-else-if="props.state === 'error'" />
  <LoadingIcon v-else-if="props.state === 'loading'" />
</template>
<script setup>
  import CheckIcon from '~/js/components/icons/CheckIcon'
  import CrossIcon from '~/js/components/icons/CrossIcon'
  import LoadingIcon from '~/js/components/icons/LoadingIcon'

  const props = defineProps({
    state: {
      type: String,
      required: true
    }
  })
</script>
