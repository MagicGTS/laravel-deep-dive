<template>
  <section class="contacts">
    <p class="caption">Единый бесплатный номер</p>
    <a class="phone_link" href="tel:+78002011670">8 (800) 201-16-70</a>
    <p class="button">
        <a href class="btn_rnd_lw__link">
          <span class="btn_rnd_lw__text">Обратный звонок</span>
        </a>
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