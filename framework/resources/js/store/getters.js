let getters = {
    phpinfo: (state) => {
        return state.phpinfo
    },
    SiteNavMenu: (state)=>(section) => {
        return state.sitemap[section];
    },
    active_cource: (state) => {        
        return (state.cources.isLoaded)?state.cources.list[state.cources.active]:{isLoaded: state.cources.isLoaded}
    }
}

export default getters