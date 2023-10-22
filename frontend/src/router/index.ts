import { createRouter, createWebHistory } from "vue-router";

// import CountriesView from '../pages/CountriesView.vue'
// import CountryView from '../pages/CountryView.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "countries",
      component: () => import("../pages/CountriesView.vue")
    },
    {
      path: "/country/:name",
      name: "country",
      component: () => import("../pages/CountryView.vue")
    }
  ]
});

export default router;
