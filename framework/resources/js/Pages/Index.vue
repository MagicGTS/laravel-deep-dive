<template>
  <app-layout :title="title" :display="display" :menu="menu">
    <template #header> </template>
    <slider-cources/>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import SliderCources from "@/9784023/Fragments/SliderCources.vue";

export default defineComponent({
  props: {
    title: String,
    display: String,
    menu: Array,
  },
  components: {
    AppLayout,
    SliderCources,
  },
});
</script>
