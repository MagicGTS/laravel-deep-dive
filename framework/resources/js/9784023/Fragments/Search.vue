<template>
  <section class="search">
    <form action="#">
      <svg width="1.25rem" height="1.1875rem">
        <use xlink:href="/img/search.svg#search" />
      </svg>
      <input type="text" class="search-input" />
    </form>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/Search.less";
</style>
<script>
import { defineComponent } from "vue";

export default defineComponent({});
</script>