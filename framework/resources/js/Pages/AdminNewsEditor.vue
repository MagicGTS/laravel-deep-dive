<template>
  <app-layout
    :title="title"
    :display="display"
    :menu="menu"
    :canLogin="canLogin"
    :canRegister="canRegister"
  >
    <template #header></template>
    <section v-if="news_editor.isLoaded">
      <h2>Редактируем - {{ news_editor.content.title }}</h2>

      <QuillEditor
        v-if="news_editor.isLoaded"
        theme="snow"
        v-model:content="editorContent"
        contentType="html"
      />
      <a href="#" @click.prevent="Save()">Save</a>
      <pre>{{ news_editor.content.description }}</pre>
    </section>
  </app-layout>
</template>

<script>
import { defineComponent, onMounted, ref, toRefs, toRef } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { useStore } from 'vuex'
import { useVuex } from '@vueblocks/vue-use-vuex'

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
  setup(props) {
    const store = useStore()
    const { useState, useMutations, useActions } = useVuex('newseditor', store)
    const editorContent = ref("")
    function Save() {
      let tmp = store.state.newseditor.news.content//{
        //id: store.state.newseditor.news.content.id
        /* "news_topic_external_id": 1,
        "title": "Больше возможностей для студентов с инвалидностью: Минтруд России и МГТУ им. Баумана подписали соглашение о сотрудничестве",
        "description": "Минтруд России и МГТУ им. Баумана подписали соглашение о сотрудничестве в развитии инклюзивного образования. Уже сегодня в университете обучаются 150 студентов с инвалидностью по специализированным адаптированным программам обучения. Студенты занимаются в 60 различных группах по 12 направлениям подготовки. \r\nВ университет поступают выпускники специализированных колледжей, подведомственных Минтруду России, в которых обучающиеся...",
        "link": "https://mintrud.gov.ru/news/news/view/5029",
        "category": "Социальная защита",
        "guid": "85ca0e7abed4302e59b07234ff56c189",
        "pubDate": "2022-02-16 13:10:37", */
      //};
      tmp.description = editorContent.value
      store.commit('newseditor/SET_NEWS', tmp)
      store.dispatch('newseditor/UpdateNews')
    };
    onMounted(() => {
      store.commit('newseditor/SET_NEWS', props.news)
      editorContent.value = props.news.description
    })
    return {
      ...useState({
        news_editor: store => store.news,
      }),
      ...useMutations({
        SetNews: "SET_NEWS",
      }),
      ...useActions([
        'UpdateNews',
      ]),
      editorContent,
      Save,
    }
  }

});
</script>
