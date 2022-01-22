<template>
  <app-layout :title="title" :menu="menu">
    <template #header> </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
  props: {
    title: String,
    menu: Array,
  },
  components: {
    AppLayout,
  },
});
</script>
