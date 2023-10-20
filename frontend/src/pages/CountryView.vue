<script setup>
import {useRoute} from 'vue-router';
import {ref} from "vue";
import CountryAPI from "@/api/CountryAPI";

const route = useRoute();

const countryName = ref(null);
countryName.value = route.params.name;

const country = ref(null);

country.value = await CountryAPI.getCountry(countryName.value);
console.log(await CountryAPI.getCountry(countryName.value))

</script>

<template>
    <div class="about">
        <div>
            <h1>
                {{ countryName }}
                {{ country.flag }}
            </h1>
            (<a :href="country.maps.googleMaps" target="_blank">Open Map</a>)
        </div>
        <div>
            Region - {{ country.region }}
        </div>
        <div>
            Sub Region - {{ country.subregion }}
        </div>
        <div>
            Languages - {{ Object.values(country.languages).toString() }}
        </div>
        <div>
            <h4>Coat of Arms</h4>
            <img :src="country.coatOfArms.png" style="width: 200px"/>
        </div>
    </div>
</template>

<style>
@media (min-width: 1024px) {
    .about {
    }
}
</style>
