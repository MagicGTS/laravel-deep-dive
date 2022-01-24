<template>
  <footer class="footer">
    <section class="footer-ribbon-top">
      <div class="footer-ribbon-top-wrap wrap padding-global">
        <contacts-big class="contacts_big" />
        <yandex-map class="ya_map" />
      </div>
    </section>
    <section class="footer-ribbon-midle">
      <div class="footer-ribbon-midle-wrap wrap padding-global">
        <section class="column column-logo">
          <app-logo />
        </section>
        <section class="column">
          <h2>Информация</h2>
          <site-nav-menu section="Information" />
        </section>
        <section class="column">
          <h2>Обучение</h2>
          <site-nav-menu section="Learning" />
        </section>
      </div>
    </section>
    <section class="footer-ribbon-bottom">
      <div class="footer-ribbon-bottom-wrap wrap padding-global">
        <section class="column">
          <news-subscription />
        </section>
        <section class="column copyright">
          <h2>Учебный центр “Амулет” 2021</h2>
          <p>
            <Link :href="route('Stub')" class="gdpr_link"
              >Политика персональных данных
            </Link>
          </p>
        </section>
        <section class="column"><social-media /></section>
      </div>
    </section>
  </footer>
</template>

<style lang="less" scoped>
@import (less) "@/9784023/Footer.less";
</style>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import YandexMap from "@/9784023/Fragments/YandexMap.vue";
import ContactsBig from "@/9784023/Fragments/ContactsBig.vue";
import AppLogo from "@/9784023/Fragments/Logo.vue";
import SiteNavMenu from "@/9784023/Fragments/SiteNavMenu.vue";
import NewsSubscription from "@/9784023/Fragments/NewsSubscription.vue";
import SocialMedia from "@/9784023/Fragments/SocialMedia.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    YandexMap,
    ContactsBig,
    AppLogo,
    SiteNavMenu,
    NewsSubscription,
    SocialMedia,
  },
});
</script>
