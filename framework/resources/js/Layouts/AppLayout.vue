<template>
  <Head :title="title" :display="display" />
  <Header :menu="menu" :canLogin="canLogin" :canRegister="canRegister"/>
  <main>
    <slot></slot>
  </main>
  <Footer />
  <modal id="message_modal" :active="true"/>
</template>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "@/9784023/Header.vue";
import Footer from "@/9784023/Footer.vue";
import Modal from "@/9784023/Fragments/Modal.vue";

export default defineComponent({
  props: {
    title: String,
    display: String,
    menu: Array,
    canLogin: Boolean,
    canRegister: Boolean,
  },

  components: {
    Head,
    Link,
    Header,
    Footer,
    Modal,
  },

  methods: {
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
});
</script>