<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mt-8 text-2xl" v-html="phpinfo.raw"></div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { mapGetters } from "vuex";
export default defineComponent({
  mounted() {
    this.$store.dispatch("getPHPInfo");
  },
  computed: {
    ...mapGetters(["phpinfo"]),
  },
});
</script>
