import { createStore } from 'vuex'
import axios from 'axios';
import actions from './actions'
import mutations from './mutations'
import getters from './getters'
import state from "./state";
import modal from './modules/modal'

export default createStore({
    state,
    mutations,
    getters,
    actions,
    modules: {
        modal
      },
})