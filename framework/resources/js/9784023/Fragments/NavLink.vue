<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>

<style lang="less" scoped>
@import (less) "css/NavLink.less";
</style>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: ["href", "active"],

  computed: {
    classes() {
      return this.active
        ? "nav_item nav_link nav_item__active"
        : "nav_item nav_link";
    },
  },
});
</script>
