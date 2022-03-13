<template>
    <app-layout
        :title="title"
        :display="display"
        :menu="menu"
        :canLogin="canLogin"
        :canRegister="canRegister"
    >
        <template #header> </template>
        <h2>Новости</h2>
        <ul>
            <li v-for="item in news" :key="item.id">
                <Link :href="route('NewsEditor', { id: item.guid })">
                    {{ item.title }}
                </Link>
            </li>
        </ul>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    props: {
        title: String,
        display: String,
        menu: Array,
        canLogin: Boolean,
        canRegister: Boolean,
        news: Array,
    },
    components: {
        AppLayout,
        Link,
    },
});
</script>
