<template>
  <section
    class="slider-course"
    v-if="cources.isLoaded"
    v-lazy:background-image="active_cource.background"
    
  >
    <div class="slider-course-wrap wrap padding-global">
      <section class="slider-course__header">
        <app-logo />
        <section class="phones-email clear-fix">
          <p class="phone">
            <a href="tel:+74959784023">+7 (495) 978-40-23</a>
          </p>
          <p class="phone">
            <a href="tel:+74955895208">+7 (499) 589-52-08</a>
          </p>
          <p class="email">
            <a href="mailto:9784023@gmail.com">9784023@gmail.com</a>
          </p>
        </section>
      </section>
      <section class="slider-course__content">
        <slider-cource :cource="active_cource" />
      </section>
      <section class="slider-course__control">
        <div class="slider-course__button">
          <Link :href="route(active_cource.component)" class="btn-sqr_dl__link">
            <span class="btn-sqr_dl__text">Подробнее о курсе</span>
          </Link>
        </div>
        <div class="slider-course__selector clear-fix">
          <a
            :href="route(item.component)"
            @click.prevent="SelectCource(id)"
            v-for="(item, id) in cources.list"
            :key="id"
            :class="id == cources.active ? 'selector active' : 'selector'"
          />
        </div>
      </section>
    </div>
  </section>
</template>

<style lang="less" scoped>
@import (less) "css/SliderCources.less";
</style>
<script>
import { defineComponent } from "vue";
import { mapGetters, mapState, mapMutations, mapActions } from "vuex";
import { Link } from "@inertiajs/inertia-vue3";
import AppLogo from "@/9784023/Fragments/Logo.vue";
import SliderCource from "@/9784023/Fragments/SliderCource.vue";

export default defineComponent({
  components: {
    Link,
    SliderCource,
    AppLogo,
  },
  mounted() {
    this.getCources();
  },
  methods: {
    ...mapMutations('slider', {
      SelectCource: "SET_ACTIVE_COURCES",
    }),
    ...mapActions('slider', ['getCources']),
  },
  computed: {
    ...mapGetters('slider', ["active_cource"]),
    ...mapState({
      cources: (state) => state.slider.cources,
    }),
  },
});
</script>
