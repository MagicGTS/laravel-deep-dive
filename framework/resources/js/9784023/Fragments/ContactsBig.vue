<template>
<section class="contacts">
  <h1>Контакты</h1>
  <address class="address">
    <h2>Проезд:</h2>
    <p>107497, г. Москва, ул. Монтажная д.3, стр.2, офис 25.</p>
    <p>м. Щелковская (первый вагон из центра).</p>
    <p>Автобус №3 или №627 (остановка «Тарная фабрика»).</p>
  </address>
  <section class="phones-email clear-fix">
    <h2>Многоканальный телефон:</h2>
    <p><a href="tel:+74959784023">+7 (495) 978-40-23</a></p>
    <p><a href="tel:+74996535021">+7 (499) 653-50-21</a></p>
    <h2>Факс:</h2>
    <p><a href="tel:+74956477550">+7 (495) 647-75-50</a></p>
    <h2>Написать Email:</h2>
    <p><a href="mailto:9784023@gmail.com">9784023@gmail.com</a></p>
  </section>
</section>
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