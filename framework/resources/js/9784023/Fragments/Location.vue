<template>
  <section class="location">
    <p>
      г. Москва, ул. Монтажная, 3,
      <br />стр. 2, офис 25
    </p>
    <p class="location_link">
      <Link :href="route('Location')">
        <svg width="10" height="10">
          <use href="img/arrow-location.svg#arrow" />
        </svg>
        Посмотреть на карте
      </Link>
    </p>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/Location.less";
</style>
<script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
});
</script>