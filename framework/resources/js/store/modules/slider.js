const state = () => ({
  loaded: false,
  cources: { active: 0, list: [], isLoaded: false },
})
let actions = {
  getCources({ commit }) {
    axios
      .get("/api/cources")
      .then((res) => {
        commit("GET_COURCES", res.data.raw);
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
let getters = {
  active_cource: (state) => {
    return (state.cources.isLoaded) ? state.cources.list[state.cources.active] : { isLoaded: state.cources.isLoaded }
  }
}
let mutations = {
  GET_COURCES(state, cources) {
    return state.cources = {
      active: 0, list: cources, isLoaded: true
    }
  },
  SET_ACTIVE_COURCES(state, id) {
    if (state.cources.list.hasOwnProperty(id)) {
      return state.cources.active = id;
    }
    return;
  },
}
export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations
}