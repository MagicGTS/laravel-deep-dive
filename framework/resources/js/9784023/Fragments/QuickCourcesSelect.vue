<template>
    <section class="quickcources" v-if="cources.isLoaded">
        <section class="quickcources-wrap wrap padding-global">
            <h2>Быстрый подбор онлайн-курса</h2>
            <ul class="quickcources__list">
                <li v-for="(item,key) in cources.list" :key="key" class="quickcources__item">
                    <cource-card
                        :href="(item.component)?item.component:'Stub'"
                        :title="(item.title.length<24)?item.title:item.slug"
                        :img="item.images.icon"
                        :description="item.description"
                        :btn_text="item.btn_text"
                        :slug="item.slug"
                    />
                </li>
            </ul>
            <h3 class="clear-fix">
                Больше курсов
                <button class="hamburger hamburger--squeeze" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </h3>
        </section>
    </section>
</template>

<style lang="less" scoped>
@import (less) "css/QuickCourcesSelect.less";
</style>
<script>
import { defineComponent } from "vue";
import { mapActions, mapState } from "vuex";
import { Link } from "@inertiajs/inertia-vue3";
import CourceCard from "@/9784023/Fragments/CourceCard.vue";

export default defineComponent({
    components: {
        Link,
        CourceCard,
    },
    mounted() {
        this.getCources();
    },
    computed: {
        ...mapState({
            cources: (state) => state.quickcources.cources,
        }),
    },
    methods: {
        ...mapActions('quickcources', ['getCources']),
    },
});
</script>
