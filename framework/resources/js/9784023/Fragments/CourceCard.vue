<template>
    <section class="cource-small-card">
        <div class="cource-small-card__content">
            <div class="cource-small-card__top">
                <div class="cource-small-card__title">{{ title }}</div>
                <div class="cource-small-card__icon" :style="style">
                    <img v-if="img.mime != 'image/svg'" :src="img.path" />
                    <svg v-else>
                        <use v-bind="{ 'xlink:href': (img.path + '#icon') }" />
                    </svg>
                </div>
            </div>
            <div class="cource-small-card__desc">{{ description }}</div>
        </div>
        <div class="btn-sqr2_dl">
            <Link :href="route('Cource', { slug: slug })" class="btn-sqr2_dl__link">
                <span class="btn-sqr2_dl__text"></span>
                {{ buttontText }}
            </Link>
        </div>
    </section>
</template>

<style lang="less" scoped>
@import (less) "css/CourceCard.less";
</style>
<script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: ["href", "active", "title", "img", "description", "btn_text", "slug"],
    computed: {
        classes() {
            return this.active
                ? "site_nav_item site_nav_link site_nav_item__active"
                : "site_nav_item site_nav_link";
        },
        buttontText() {
            return this.btn_text ? this.btn_text : "Подробнее о курсе";
        },
        style() {
            return {
                width: (this.img.width ? this.img.width : '3.9375rem'),
                height: (this.img.height ? this.img.height : '3.9375rem')
            }
        },
    },
});
</script>
