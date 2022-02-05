<template>
  <app-layout :title="title" :display="display" :menu="menu">
    <template #header> </template>
    {{ title }}
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default defineComponent({
  props: {
    title: String,
    display: String,
    menu: Array,
  },
  components: {
    AppLayout,
  },
});
</script>
