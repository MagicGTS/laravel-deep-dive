let mutations = {
    GET_PHPINFO(state, phpinfo) {
        return state.phpinfo = phpinfo
    },
    GET_SITEMAP(state, payload) {
        return state.sitemap[payload.section] = payload.data;
    },
    GET_COURCES(state, cources) {        
        return state.cources = {
            active: 0, list: cources, isLoaded: true
        }
    },
    SET_ACTIVE_COURCES(state, id) {
        if(state.cources.list.hasOwnProperty(id)){
            return state.cources.active = id;
        }       
        return;
    },
}
export default mutations