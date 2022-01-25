<template>
  <section class="slider__text" v-html="cource.display"></section>
  <div class="slider__img">
    <Link :href="route(cource.component)">
      <img
        :src="cource.img.src"
        alt=""
        :style="{ width: cource.img.width, height: cource.img.height }"
    /></Link>
  </div>
</template>

<style lang="less" scoped>
@import (less) "css/SliderCource.less";
</style>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },
  props: {
    cource: Object,
  },
});
</script>