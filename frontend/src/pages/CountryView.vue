<script lang="ts" setup>
import { useRoute } from "vue-router";
import { ref } from "vue";
import CountryAPI from "@/api/CountryAPI";

const route = useRoute();

// state
const country = ref();

const countryName = route.params.name as string;

country.value = await CountryAPI.getCountry(countryName);

// variables
const officialName = country.value.name.official;
const mapsLink = country.value.maps.googleMaps;
</script>

<template>
  <div class="about">
    <div>
      <h1>
        {{ officialName }}
        {{ country?.flag }}
      </h1>
      (<a :href="mapsLink" target="_blank">Open Map</a>)
    </div>
    <div>Region - {{ country.region }}</div>
    <div>Sub Region - {{ country.subregion }}</div>
    <div>Languages - {{ Object.values(country.languages).toString() }}</div>
    <div>
      <h4>Coat of Arms</h4>
      <img :src="country.coatOfArms.png" style="width: 200px" />
    </div>
  </div>
</template>
