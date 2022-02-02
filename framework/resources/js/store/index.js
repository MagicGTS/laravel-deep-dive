import { createStore } from 'vuex'
import actions from './actions'
import mutations from './mutations'
import getters from './getters'
import state from "./state";
import modal from './modules/modal'
import slider from './modules/slider'
import quickcources from './modules/quickcources'
import sitemap from './modules/sitemap'

export default createStore({
  state,
  mutations,
  getters,
  actions,
  modules: {
    modal,
    slider,
    quickcources,
    sitemap,
  },
})