const state = () => ({
  loaded: false,
  cources: { list: [], isLoaded: false },
})
let actions = {
  getCources({ commit }) {
    axios
      .get("/api/quickcources")
      .then((res) => {
        commit("GET_COURCES", res.data.raw);
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
let mutations = {
  GET_COURCES(state, cources) {
    return state.cources = {
      list: cources, isLoaded: true
    }
  }
}
export default {
  namespaced: true,
  state,
  actions,
  mutations
}