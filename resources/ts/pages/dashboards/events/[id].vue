<script lang="ts" setup>
import type { EventData } from '@/views/dashboards/event/types';
import { useEventStore } from '@/views/dashboards/event/useEventStore';

const eventListStore = useEventStore();
const route = useRoute();
const eventData = ref<EventData>();

// 👉 fetch selected event
eventListStore
  .fetchEvent(Number(route.params.id))
  .then((response) => {
    const data = response.data;
    eventData.value = data;
    // {
    //   title: data.title,
    //   time: '',
    //   date: '',
    //   url: '',
    // }
    console.info('SUCCESS FETCH EVENT', eventData);
  })
  .catch((error) => {
    console.error(`ERROR FETCH EVENT`, error);
  });
</script>

<template>
  <h2>DETAIL EVENT</h2>
</template>
