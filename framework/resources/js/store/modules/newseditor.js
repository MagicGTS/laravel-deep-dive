const state = () => ({
  loaded: false,
  news: { content: '', isLoaded: false },
});

let mutations = {
  SET_NEWS(state, news) {
    return state.news = {
      content: news, isLoaded: true
    }
  }
}
export default {
  namespaced: true,
  state,
  mutations
}