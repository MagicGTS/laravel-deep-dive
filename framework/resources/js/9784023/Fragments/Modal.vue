<template>
  <section :class="classes" :id="id" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-header">
        <h2>{{ titleText }}</h2>
        <a
          href="#"
          class="btn-close"
          aria-hidden="true"
          @click.prevent="ModalClose"
          >×</a
        >
      </div>
      <div class="modal-body">
        <p v-if="$page.props.flash.message && displayed">
          {{ $page.props.flash.message }}
        </p>
        <p v-if="$page.props.errors.message && displayed">
          {{ $page.props.errors.message }}
        </p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" @click.prevent="ModalClose">{{
          buttontText
        }}</a>
      </div>
    </div>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/Modal.less";
</style>
<script>
import { defineComponent } from "vue";
import { mapState } from "vuex";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  data() {
    return {
      displayed: false,
    };
  },
  watch: {
    "$page.flash": {
      handler() {
        this.displayed = true;
      },
      deep: true,
    },
  },
  components: {
    Link,
  },
  props: {
    id: String,
    button: String,
    title: String,
  },
  computed: {
    ...mapState({
      modalStatus: (state) => state.modal.displayed,
    }),
    classes() {
      return this.displayed ? "modal modal__open" : "modal";
    },
    buttontText() {
      return this.button ? this.button : "Ok";
    },
    titleText() {
      return this.title ? this.title : "Сообщение";
    },
  },
  methods: {
    ModalClose() {
      this.displayed = false;
    },
  },
});
</script>
