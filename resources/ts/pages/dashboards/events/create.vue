<script lang="ts" setup>
import EventEditable from '@/views/dashboards/event/EventEditable.vue';

// Type Event Data
import { EventData } from '@/views/dashboards/event/types';

//👉 - DEFAULT BLANK DATA
const eventData = ref<EventData>({
  title: '',
  time: '',
  date: '',
  url: '',
});
</script>

<template>
  <div>
    <!-- <VLabel>Create Event</VLabel> -->
    <VSpacer class="mb-8" />
    <VRow>
      <!-- 👉 Event Editable -->
      <VCol cols="12" md="15">
        <EventEditable :data="eventData" />
      </VCol>
    </VRow>
  </div>
</template>
