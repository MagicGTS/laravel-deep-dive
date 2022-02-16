<template>
  <app-layout :title="title" :display="display" :menu="menu" :canLogin="canLogin" :canRegister="canRegister">
    <template #header > </template>
    <slider-cources/>
    <quick-cources-select/>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import SliderCources from "@/9784023/Fragments/SliderCources.vue";
import QuickCourcesSelect from "@/9784023/Fragments/QuickCourcesSelect.vue";

export default defineComponent({
  props: {
    title: String,
    display: String,
    menu: Array,
    canLogin: Boolean,
    canRegister: Boolean,
  },
  components: {
    AppLayout,
    SliderCources,
    QuickCourcesSelect,
  },
});
</script>
