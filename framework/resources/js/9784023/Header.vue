<template>
  <header class="header">
        <section class="search">
            <form action="#"><svg width="20" height="19">
                    <use href="img/search.svg#search"></use>
                </svg><input type="text" class="search-input"></form>
        </section>
        <section class="ribbon-top wrap padding-global">
            <nav-menu :menu="menu" />
            <section class="location">
                <p>г. Москва, ул. Монтажная, 3,<br> стр. 2, офис 25</p>
                <p>
                    <a href="#">
                        <svg width="10" height="10">
                            <use href="img/arrow-location.svg#arrow"></use>
                        </svg> Посмотреть на карте
                    </a>
                </p>
            </section>
            <section class="contacts">
                <p>Единый бесплатный номер</p>
                <p>8 (800) 201-16-70</p>
                <p>
                    <span class="btn-rnd_lb">
                        <a href="" class="btn-rnd_lb__link">
                            <span class="btn-rnd_lb__text">Обратный звонок</span>
                        </a>
                    </span>
                </p>
            </section>
        </section>
    </header>
</template>
<style lang="less" scoped>
@import (less) './Header.less';
</style>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import NavMenu from "@/9784023/Fragments/NavMenu.vue";

export default defineComponent({  
  props: {
    menu: Array,
  },
  components: {
    Link,
    NavMenu,
  },
});
</script>