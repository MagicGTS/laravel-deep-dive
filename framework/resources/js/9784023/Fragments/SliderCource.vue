<template>
  <section class="slider__text" v-html="cource.display"></section>
  <div class="slider__img">
    <Link :href="route(cource.component)">
      <img
        v-lazy="cource.img.src"
        alt=""
        :style="style"
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
  computed: {
    style() {
      return { 
        width: (this.cource.img.width? this.cource.img.width: '30.3125rem'),
        height: (this.cource.img.height? this.cource.img.height: '31rem')
      }
    },
  },
});
</script>