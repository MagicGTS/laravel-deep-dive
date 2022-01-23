<template>
  <footer class="footer">
        <section class="footer-top-ribbon">
            <div class="footer-top-ribbon-wrap wrap padding-global">
                <contacts-big/>
                <yandex-map/>
            </div>
        </section>
        <section class="footer-midle-ribbon">
            <div class="footer-midle-ribbon-wrap wrap padding-global">
            </div>
        </section>
        <section class="footer-bottom-ribbon">
            <div class="footer-bottom-ribbon-wrap wrap padding-global">
            </div>
        </section>
    </footer>
</template>
<style lang="less" scoped>
</style>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import YandexMap from "@/9784023/Fragments/YandexMap.vue";
import ContactsBig from "@/9784023/Fragments/ContactsBig.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    YandexMap,
    ContactsBig,
  },
});
</script>