const state = () => ({
  news: { content: 'gggg', isLoaded: false },
});

let mutations = {
  SET_NEWS(state, news) {
    return state.news = {
      content: news, isLoaded: true
    }
  }
}
let actions = {
  UpdateNews(context) {
    axios.post('/admin/newsedit', { news: context.state.news.content })
  }
}
export default {
  namespaced: true,
  state,
  mutations,
  actions
}