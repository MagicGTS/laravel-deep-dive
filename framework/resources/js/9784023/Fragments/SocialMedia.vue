<template>
  <section class="socialmedia">
    <h2>Мы в соц. сетях</h2>
    <p class="sochialnets">
      <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
    </p>
    <p><Link :href="route('Stub')" class="sitemap_link">Карта сайта </Link></p>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/SocialMedia.less";
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