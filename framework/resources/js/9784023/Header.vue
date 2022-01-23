<template>
  <header class="header">
    <search-menu/>
    <section class="ribbon-top wrap padding-global">
      <nav-menu :menu="menu" />
      <location-menu />
      <contacts-small/>
      </section>
  </header>
</template>
<style lang="less" scoped>
@import (less) "@/9784023/Header.less";
</style>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import NavMenu from "@/9784023/Fragments/NavMenu.vue";
import SearchMenu from "@/9784023/Fragments/Search.vue";
import LocationMenu from "@/9784023/Fragments/Location.vue";
import ContactsSmall from "@/9784023/Fragments/ContactsSmall.vue";

export default defineComponent({
  props: {
    menu: Array,
  },
  components: {
    Link,
    NavMenu,
    SearchMenu,
    LocationMenu,
    ContactsSmall,
  },
});
</script>