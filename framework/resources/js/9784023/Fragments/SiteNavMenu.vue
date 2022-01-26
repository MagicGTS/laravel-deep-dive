<template>
  <nav>
    <ul class="site_nav_list"><li v-for="item in SiteNavMenu(section)" :key="item.id">
        <site-nav-link
          :href="route(item.component)"
          :active="route().current(item.component)"
          v-html="item.display ? item.display : item.title"
        />
      </li>
    </ul>
  </nav>
</template>

<style lang="less" scoped>
@import (less) "css/SiteNavMenu.less";
</style>
<script>
import { defineComponent } from "vue";
import { mapGetters } from "vuex";
import SiteNavLink from "@/9784023/Fragments/SiteNavLink.vue";

export default defineComponent({
  mounted() {
    this.$store.dispatch("getSiteNavMenu", this.section);
  },
  computed: {
    ...mapGetters(["SiteNavMenu"]),
  },
  props: {
    section: String,
  },
  components: {
    SiteNavLink,
  },
});
</script>