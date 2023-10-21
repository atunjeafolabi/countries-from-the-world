<script setup lang="ts">
import CountriesView from "@/pages/CountriesView.vue";
</script>

<template>
    <header>
        <h2>Countries From the World</h2>
    </header>
    <Suspense>
        <RouterView/>
    </Suspense>
</template>

<style scoped>

</style>
