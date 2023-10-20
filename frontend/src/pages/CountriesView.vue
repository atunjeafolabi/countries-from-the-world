<template>
    <EasyDataTable
            v-model:server-options="serverOptions"
            :server-items-length="serverItemsLength"
            :loading="loading"
            :headers="headers"
            :items="items"
            buttons-pagination
    />
</template>

<script lang="ts" setup>
import {ref, watch} from "vue";
import EasyDataTable from 'vue3-easy-data-table';
import type {Header, Item, ServerOptions} from "vue3-easy-data-table";
import CountryAPI from "@/api/CountryAPI";

const headers: Header[] = [
    {text: "Official Name", value: "name.official"},
    {text: "Capital", value: "capital"},
    {text: "Sub Region", value: "subregion", sortable: true},
    {text: "region", value: "region", sortable: true},
    {text: "Flag", value: "flag"},
];

const items = ref<Item[]>([]);
const loading = ref(false);
const serverItemsLength = ref(0);
const serverOptions = ref<ServerOptions>({
    page: 1,
    rowsPerPage: 10,
    // sortBy: 'region',
    // sortType: 'asc',
});

const loadFromServer = async () => {
    loading.value = true;
    const {
        serverCurrentPageItems,
        serverTotalItemsLength,
    } = await CountryAPI.getCountries(serverOptions.value);

    items.value = serverCurrentPageItems;
    serverItemsLength.value = serverTotalItemsLength;
    loading.value = false;
};

// initial load
loadFromServer();

watch(serverOptions, (value) => {
    loadFromServer();
}, {deep: true});
</script>

<style>
@import 'vue3-easy-data-table/dist/style.css';
</style>
