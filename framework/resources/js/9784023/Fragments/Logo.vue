<template>
  <section>
    <Link :href="route('Index')"  class="logo">
    <div class="logo-img">
      <img src="/img/logo.png" alt="" width="43" height="44" />
    </div>
    <div class="logo-text">
      <p>Учебный центр<br /><span class="hightlite">Амулет</span></p>
    </div>
  </Link>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/Logo.less";
</style>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
}});
</script>
