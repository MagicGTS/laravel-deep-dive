<template>
  <app-layout :title="title">
    <template #header> </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
  props: {
    title: String,
  },
  components: {
    AppLayout,
  },
});
</script>
