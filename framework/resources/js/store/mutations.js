let mutations = {
    GET_PHPINFO(state, phpinfo) {
        return state.phpinfo = phpinfo
    },

    GET_SITEMAP(state, payload) {
        return state.sitemap[payload.section] = payload.data;
    }
}
export default mutations