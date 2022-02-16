<template>
  <section class="login">
    <form v-if="$page.props.user" method="POST" @submit.prevent="logout">
      <a :href="route('Index')" @click.prevent="logout">Log Out</a>
    </form>
    <template v-else>
      <Link :href="route('login')" class="text-sm text-gray-700 underline">Log in</Link>

      <Link
        v-if="canRegister"
        :href="route('register')"
        class="ml-4 text-sm text-gray-700 underline"
      >Register</Link>
    </template>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/LoginPlace.less";
</style>
<script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
  },
  components: {
    Link,
  },

  methods: {
    logout() {
      this.$inertia.post(route('logout'));
    },
  }
});
</script>