<script setup lang="ts">
import type { Event } from '@/@fake-db/types';
import { useEventStore } from '@/views/dashboards/event/useEventStore';

const eventListStore = useEventStore();

const searchQuery = ref('');
const selectedStatus = ref();
const rowPerPage = ref(10);
const currentPage = ref(1);
const totalPage = ref(1);
const totalEvents = ref(0);
const events = ref<Event[]>([]);
const selectedRows = ref<string[]>([]);

// 👉 Fetch Events
watchEffect(() => {
  // console.log('CALL NOW');
  eventListStore
    .fetchEvents({
      q: searchQuery.value,
      status: selectedStatus.value,
      perPage: rowPerPage.value,
      currentPage: currentPage.value,
    })
    .then((response) => {
      const data = response.data;
      events.value = data.events;
      totalPage.value = data.totalPage;
      totalEvents.value = data.totalEvents;
      console.log(`FETCH EVENTS: ${data}`);
    })
    .catch((error) => {
      console.log(`ERROR FETCH EVENTS: ${error}`);
    });
});

// 👉 watching current page
watchEffect(() => {
  if (currentPage.value > totalPage.value) {
    currentPage.value = totalPage.value;
  }
});

// 👉 Computing pagination data
const paginationData = computed(() => {
  const firstIndex = events.value.length ? (currentPage.value - 1) * rowPerPage.value + 1 : 0;
  const lastIndex = events.value.length + (currentPage.value - 1) * rowPerPage.value;

  return `Showing ${firstIndex} to ${lastIndex} of ${totalEvents.value} entries`;
});

const sampleIcon = () => {
  return { variant: 'secondary', icon: 'tabler-x' };
};
</script>

<!-- <template>
  <div>
    <div></div>
    ~someone~
  </div>
</template> -->

<!-- <p>This Event List</p>
  <VDivider /> -->
<!-- <VCard> <VLabel>THIS EVENT LIST</VLabel>> </VCard> -->

<template>
  <div>
    <!-- <VLabel>THIS EVENT LIST</VLabel> -->
    <VCard v-if="events" id="event-list">
      <VCardText class="d-flex align-center flex-wrap gap-4">
        <!-- 👉 Rows per page -->
        <div class="d-flex align-center" style="width: 8.5rem">
          <span class="text-no-wrap me-3">Show :</span>
          <VSelect v-model="rowPerPage" density="compact" :items="[5, 10, 20, 50]" />
        </div>

        <!-- 👉 Create Event -->
        <div class="me-3">
          <!-- :to="{ name: 'apps-invoice-add' }" -->
          <VBtn
            prepend-icon="tabler-plus"
            :to="{
              // name: 'dashboards-events-create',
              name: 'dashboards-events-wizards-regist1',
            }"
          >
            Create Event
          </VBtn>
        </div>

        <VSpacer />

        <div class="d-flex align-center flex-wrap gap-4">
          <!-- 👉 Search -->
          <div class="event-list-filter">
            <VTextField v-model="searchQuery" placeholder="Search Event" density="compact" />
          </div>
          <!-- 👉 Select Stats-->
          <!-- <div class="event-list-filter">
            <VSelect
              v-model="selectedStatus"
              label="Select Status"
              clearable
              clear-icon="tabler-x"
              single-line
              :items="['Downloaded', 'Draft', 'Sent', 'Paid', 'Partial Payment', 'Past Due']"
            />
          </div> -->
        </div>
      </VCardText>

      <VDivider />

      <!-- SECTION TABLE -->

      <!-- SECTION Table -->
      <VTable class="text-no-wrap invoice-list-table">
        <!-- 👉 Table head -->
        <thead class="text-uppercase">
          <tr>
            <th scope="col">ID</th>
            <!-- <th scope="col" class="text-center">
              <VIcon icon="tabler-trending-up" />
            </th> -->

            <th scope="col">TITLE</th>

            <!-- <th scope="col" class="text-center">TOTAL</th> -->

            <th scope="col">Event Date</th>

            <!-- <th scope="col" class="text-center">BALANCE</th> -->

            <th scope="col">URL</th>
          </tr>
        </thead>

        <!-- 👉 Table Body -->
        <tbody>
          <tr v-for="event in events" :key="event.id" style="height: 3.75rem">
            <!-- 👉 Id -->
            <td>#{{ event.id }}</td>
            <!-- <td class="text-center">
              <VTooltip>
                <template #activator="{ props }">
                  <VAvatar :size="20" v-bind="props" :color="{ variant: 'primary' }.variant" variant="tonal">
                    <VIcon :size="20" :icon="sampleIcon().icon" />
                  </VAvatar>
                </template>

                <p class="mb-0">
                  {{ event.id }}
                </p>
                <p class="mb-0">Title: {{ event.title }}</p>
                <p class="mb-0">URL: {{ event.url }}</p>
              </VTooltip>
            </td> -->
            <!-- 👉 Title -->
            <td>
              <div>
                <h6 class="text-base font-weight-medium mb-0">
                  {{ event.title }}
                </h6>
              </div>
            </td>
            <!-- 👉 Date -->
            <td>
              <div>
                <h6 class="text-base font-weight-medium mb-0">
                  {{ event.eventDate }}
                </h6>
              </div>
            </td>
            <!-- 👉 URL -->
            <td>
              <div>
                <!-- 'apps-invoice-edit-id' -->
                <VBtn
                  icon
                  variant="text"
                  color="default"
                  size="x-small"
                  :to="{ name: 'dashboards-events-id', params: { id: event.id } }"
                >
                  <VIcon :size="22" icon="tabler-link" />
                </VBtn>
                <!-- <a v-bind:href="event.url"> {{ event.url.substring(8, event.url.length) }} </a> -->
                <!-- <h6 class="text-base font-weight-medium mb-0">
                  {{ event.url }}
                </h6> -->
              </div>
            </td>
          </tr>
        </tbody>
      </VTable>

      <!-- !SECTION -->

      <VDivider />

      <!-- SECTION Pagination -->
      <VCardText class="d-flex align-center flex-wrap gap-4 py-3">
        <!-- 👉 Pagination Meta -->
        <span class="text-sm text-disabled">
          {{ paginationData }}
        </span>
        <VSpacer />
        <!-- 👉 Pagination (IN NUMBER)-->
        <VPagination
          v-model="currentPage"
          size="small"
          :total-visible="5"
          :length="totalPage"
          @next="($event) => (selectedRows = [])"
          @prev="($event) => (selectedRows = [])"
        />
      </VCardText>
      <!-- !SECTION -->
    </VCard>
  </div>
</template>

<!-- 👉 SCSS -->
<style lang="scss">
#event-list {
  .event-list-actions {
    inline-size: 8rem;
  }

  .event-list-filter {
    inline-size: 12rem;
  }
}
</style>
