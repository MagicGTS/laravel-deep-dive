<template>
  <section class="newsubscription">
    <h2>Подписка на новости</h2>
    <form action="#" class="newsubscription-form">
      <input
        name="search"
        type="text"
        class="newsubscription__input"
        placeholder="Введите ваш e-mail"
      />
      <Link :href="route('Stub')" class="newsubscription__btn clear-fix">
        <svg width="1.125rem" height="1.125rem">
          <use xlink:href="img/message.svg#message" />
        </svg>
      </Link>
    </form>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/NewsSubscription.less";
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