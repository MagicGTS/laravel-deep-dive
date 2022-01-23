<template>
  <address class="address">
    <h1>Контакты</h1>
    <p>107497, г. Москва, ул. Монтажная д.3, стр.2, офис 25.</p>
    <p>м. Щелковская (первый вагон из центра).</p>
    <p>Автобус №3 или №627 (остановка «Тарная фабрика»).</p>
  </address>
</template>

<style lang="less" scoped>
@import (less) "css/ContactsBig.less";
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