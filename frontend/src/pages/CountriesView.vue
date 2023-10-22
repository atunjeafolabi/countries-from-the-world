<template>
  <EasyDataTable
    v-model:server-options="serverOptions"
    :server-items-length="serverItemsLength"
    :loading="loading"
    :headers="headers"
    :items="items"
    table-class-name="customize-table"
    buttons-pagination
    @click-row="showRow"
  />
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue';
import EasyDataTable, {
  type Header,
  type Item,
  type ServerOptions,
  type ClickRowArgument
} from 'vue3-easy-data-table';
import CountryAPI from '@/api/CountryAPI';
import router from '@/router';

const headers: Header[] = [
  { text: 'Official Name', value: 'name.official' },
  { text: 'Capital', value: 'capital' },
  { text: 'Sub Region', value: 'subregion', sortable: true },
  { text: 'Region', value: 'region', sortable: true },
  { text: 'Flag', value: 'flag' }
];

// state
const items = ref<Item[]>([]);
const loading = ref(false);
const serverItemsLength = ref(0);
const serverOptions = ref<ServerOptions>({
  page: 1,
  rowsPerPage: 10
  // sortBy: 'region',
  // sortType: 'asc',
});

// methods
const loadFromServer = async () => {
  loading.value = true;
  const { serverCurrentPageItems, serverTotalItemsLength } = await CountryAPI.getCountries(
    serverOptions.value
  );

  items.value = serverCurrentPageItems;
  serverItemsLength.value = serverTotalItemsLength;
  loading.value = false;
};
loadFromServer();

const showRow = (item: ClickRowArgument) => {
  router.push({ name: 'country', params: { name: item.name.official } });
};

// watchers
watch(
  serverOptions,
  () => {
    loadFromServer();
  },
  { deep: true }
);
</script>

<style>
@import 'vue3-easy-data-table/dist/style.css';

.customize-table {
  --easy-table-border: 1px solid #445269;
  --easy-table-row-border: 1px solid #445269;

  --easy-table-header-font-size: 18px;
  --easy-table-header-height: 50px;
}

.customize-table thead th,
.customize-table tbody tr {
  cursor: pointer;
}
</style>
