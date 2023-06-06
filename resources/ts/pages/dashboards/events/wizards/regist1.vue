<script setup lang="ts">
// FORM VALIDATION
import { emailValidator, requiredValidator } from '@validators';
import type { VForm } from 'vuetify/components';

// 👉 TEST
import { useAppAbility } from '@/plugins/casl/useAppAbility';
import { useEventStore } from '@/views/dashboards/event/useEventStore';

const eventListStore = useEventStore();

const refVForm = ref<VForm>();
const username = ref('woy');
const email = ref('');
const password = ref('woy123');
const privacyPolicies = ref(true);
// Form Errors
const errors = ref<Record<string, string | undefined>>({
  email: undefined,
  password: undefined,
});

// Router
const route = useRoute();
const router = useRouter();

// Ability
const ability = useAppAbility();

// const email = ref('');
const loadings = ref<boolean>(false);
const form = ref<VForm>();

onBeforeMount(() => {
  console.log('BEFORE MOUNT');
  return;
});

const submitEmail = () => {
  form?.value
    ?.validate()
    .then(({ valid: isValid }) => {
      if (isValid) {
        loadings.value = true;
        setTimeout(() => {
          // email.value = '';
          loadings.value = false;
          router.push('regist2');
          // eventListStore.fetchEvent
        }, 2000);
      }
    })
    .catch((error) => {
      console.error('ERROR REGIST1', error);
    });
};
</script>

<template>
  <div>
    <VLabel>Conference Registration Page</VLabel>
    <VSpacer class="ma-8" />
    <VCard>
      <!-- @submit.prevent="() => {}" -->

      <KeepAlive>
        <VForm class="ma-4" ref="form">
          <VCol md="15" class="mb-8 d-flex justify-center">
            <VTextField
              v-model="email"
              :rules="[requiredValidator, emailValidator]"
              :disabled="loadings.valueOf()"
              label="Email"
              placeholder="Email Address"
              required
            />
            <!-- <VSpacer class="ma-8" /> -->
          </VCol>

          <VCol>
            <VBtn :loading="loadings" :disabled="loadings" @click="submitEmail"> SUBMIT </VBtn>
          </VCol>
        </VForm>
      </KeepAlive>
    </VCard>
  </div>
</template>
