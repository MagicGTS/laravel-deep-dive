<template>
  <Head :title="title" />
  <Header :menu="menu"/>
  <Footer />
</template>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "@/9784023/Header.vue";
import Footer from "@/9784023/Footer.vue";

export default defineComponent({
  props: {
    title: String,
    menu: Array,
  },

  components: {
    Head,
    Link,
    Header,
    Footer,
  },

  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
});
</script>