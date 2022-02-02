const state = () => ({
  sitemap: {}
})
let actions = {
    getSiteNavMenu({ commit }, section) {
      axios
        .get("/api/sitemap", {
          params: {
            section: section,
          },
        })
        .then((res) => {
          commit("GET_SITEMAP", { section: section, data: res.data.raw });
        })
        .catch((err) => {
          console.log(err);
        });
    }
  };
let getters = {
  SiteNavMenu: (state) => (section) => {
    return state.sitemap[section];
  }
}
let mutations = {
  GET_SITEMAP(state, payload) {
    return state.sitemap[payload.section] = payload.data;
  },
}
export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations
}