<template>
  <app-layout :title="title" :display="display" :menu="menu" :canLogin="canLogin" :canRegister="canRegister">
    <template #header > </template>
    <h2>Редактируем - {{ news.title }}</h2>
    <QuillEditor theme="snow" v-model:content="news_editor.content"  contentType="html" />
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { mapState, mapMutations } from "vuex";

export default defineComponent({
  props: {
    title: String,
    display: String,
    menu: Array,
    canLogin: Boolean,
    canRegister: Boolean,
    news: Object,
  },
  components: {
    AppLayout,
    QuillEditor
  },
  created() {
    this.SetNews(this.news);
  },
  methods: {
    ...mapMutations('newseditor', {
      SetNews: "SET_NEWS",
    }),
  },
  computed: {
    ...mapState({
      news_editor: (state) => state.newseditor,
    }),
  },
  
});
</script>
