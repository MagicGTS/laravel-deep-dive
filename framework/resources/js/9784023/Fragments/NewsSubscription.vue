<template>
  <section class="newsubscription">
    <h2>Подписка на новости</h2>
    <form @submit.prevent="submit" class="newsubscription-form">
      <input
        name="email"
        id="email"
        v-model="form.email"
        type="email"
        class="newsubscription__input"
        placeholder="Введите ваш e-mail"
      />
      <a :href="route('Index')" @click.prevent="submit" :class="classes"
        ><svg width="1.125rem" height="1.125rem">
          <use xlink:href="/img/message.svg#message" /></svg
      ></a>
    </form>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/NewsSubscription.less";
</style>
<script>
import { defineComponent } from "vue";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
export default defineComponent({
  data() {
    return {
      active: true,
    };
  },
  setup() {
    const form = reactive({
      email: null,
    });

    function submit() {
      this.active = false;
      Inertia.post("/emailnewssubscribe", form, {
        onSuccess: () => {
          this.active = true;
        },
        onError: () => {
          this.active = false;
        }
      });
      setTimeout(() => {
        this.active = true;
      }, 5000);
    }

    return { form, submit };
  },

  computed: {
    classes() {
      return this.active
        ? "newsubscription__btn"
        : "newsubscription__btn newsubscription__btn_disabled";
    },
  },
});
</script>