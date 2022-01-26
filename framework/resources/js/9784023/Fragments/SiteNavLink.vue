<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>

<style lang="less" scoped>
@import (less) "css/SiteNavLink.less";
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
        ? "site_nav_item site_nav_link site_nav_item__active"
        : "site_nav_item site_nav_link";
    },
  },
});
</script>
