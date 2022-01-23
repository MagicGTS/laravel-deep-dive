<template>
  <section class="contacts">
    <p>Единый бесплатный номер</p>
    <p class="phone_link">8 (800) 201-16-70</p>
    <p class="btn_place">
      <span class="btn-rnd_lb">
        <a href class="btn-rnd_lb__link">
          <span class="btn-rnd_lb__text">Обратный звонок</span>
        </a>
      </span>
    </p>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/ContactsSmall.less";
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