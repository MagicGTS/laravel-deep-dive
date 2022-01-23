<template>
  <nav>
    <ul class="nav_list">
      <li v-for="item in menu" :key="item.id">
        <nav-link
          :href="route(item.component)"
          :active="route().current(item.component)"
          v-html="item.display ? item.display : item.title"
        />
      </li>
    </ul>
  </nav>
</template>

<style lang="less" scoped>
@import (less) "css/NavMenu.less";
</style>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import NavLink from "@/9784023/Fragments/NavLink.vue";

export default defineComponent({
  props: {
    menu: Array,
  },
  components: {
    Link,
    NavLink,
  },
});
</script>