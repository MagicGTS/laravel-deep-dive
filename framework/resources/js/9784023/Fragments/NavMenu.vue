<template>
<nav>
                  <ul class="nav-list">
                     <li v-for="item in menu" :key="item.id">
                        <jet-nav-link :href="route(item.component)" :active="route().current(item.component)"  v-html="item.title"/>
    
  </li> 
                    
                    <!-- <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Главная</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap nav-item__active"><a href="" class="nav-link">О&nbsp;центре</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Каталог&nbsp;услуг</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Цены</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Акции</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Новости</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Контакты</a></div>
                    </li> -->
             </ul>
            </nav>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import JetNavLink from '@/Jetstream/NavLink.vue'

export default defineComponent({  
  props: {
    menu: Array,
  },
  components: {
    Link,
    JetNavLink,
  },
});
</script>