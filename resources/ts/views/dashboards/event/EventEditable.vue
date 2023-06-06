<script lang="ts" setup>
import { VNodeRenderer } from '@/@layouts/components/VNodeRenderer';
import { themeConfig } from '@themeConfig';
import { EventData } from './types';
import { useEventStore } from './useEventStore';

// FORM VALIDATION
import { requiredValidator, urlValidator } from '@validators';
import type { VForm } from 'vuetify/components';

interface Props {
  data: EventData;
}

const props = defineProps<Props>();
const eventListStore = useEventStore();

const title = ref('');
const time = ref('');
const date = ref('');
const url = ref('');
const form = ref<VForm>();
const loadings = ref<boolean[]>([]);

const createEvent = (i: number) => {
  // form?.validate();
  form?.value?.validate().then((result) => {
    const isValid = result.valid;
    console.log(`FORM VALID: ${isValid}`);
    if (isValid) {
      loadings.value[i] = true;
      setTimeout(() => {
        loadings.value[i] = false;
      }, 2500);
    }
  });
};
</script>

<template>
  <VCard>
    <!-- SECTION Header -->
    <!-- class="d-flex flex-wrap justify-space-between flex-column flex-sm-row" -->
    <VCardText>
      <!-- 👉 Left Content -->
      <div class="ma-sm-4">
        <div class="d-flex align-center mb-6">
          <!-- 👉 Logo -->
          <VNodeRenderer :nodes="themeConfig.app.logo" class="me-3" />

          <!-- 👉 Title -->
          <h6 class="font-weight-bold text-xl">Create Event</h6>
        </div>
      </div>
    </VCardText>
    <VDivider />

    <VForm class="ma-8" ref="form" @submit.prevent="() => {}">
      <VRow>
        <VCol cols="12">
          <VTextField
            v-model="title"
            :rules="[requiredValidator]"
            persistent-placeholder
            label="Title"
            placeholder="Title"
            required
          />
        </VCol>
        <VCol cols="12" md="6">
          <AppDateTimePicker v-model="date" :rules="[requiredValidator]" persistent-placeholder label="Date" required />
          <!-- <VTextField v-model="time" :rules="[requiredValidator]" label="Event Time" required /> -->
        </VCol>
        <VCol cols="12" md="6">
          <AppDateTimePicker
            v-model="time"
            :rules="[requiredValidator]"
            persistent-placeholder
            label="Time"
            required
            :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i' }"
          />
        </VCol>
        <VCol cols="12" md="6">
          <VTextField
            v-model="url"
            :rules="[requiredValidator, urlValidator]"
            persistent-placeholder
            label="Url"
            required
          />
        </VCol>

        <VCol cols="12">
          <VBtn type="submit" :loading="loadings[0]" :disabled="loadings[0]" @click="createEvent(0)"> Create </VBtn>
        </VCol>
      </VRow>
    </VForm>

    <!-- <VTextField class="ma-4" v-model="props.data.title" placeholder="Event Title" /> -->
    <!-- <VTextField class="ma-4" v-model="props.data.time" placeholder="Event Time" />
    <VTextField class="ma-4" v-model="props.data.date" placeholder="Event Date" />
    <VTextField class="ma-4" v-model="props.data.url" placeholder="Event Url" /> -->
    <!-- !SECTION -->

    <!-- <h6 class="font-weight-bold text-xl">
      {{ themeConfig.app.title }}
    </h6> -->
  </VCard>
</template>
