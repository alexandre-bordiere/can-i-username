<template>
  <div>
    <IntegrationsListItem
      v-for="integration in integrations"
      :key="integration"
      :integration="integration"
    />
  </div>
</template>
<script setup>
  import IntegrationsListItem from '~/js/components/integrations/IntegrationsListItem'
  import { useIntegrations } from '~/js/composables/useIntegrations'

  const { integrations } = useIntegrations()
</script>
