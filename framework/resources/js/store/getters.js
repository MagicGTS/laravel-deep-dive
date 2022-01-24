let getters = {
    phpinfo: state => {
        return state.phpinfo
    },
    SiteNavMenu: (state)=>(section) => {
        return state.sitemap[section];
    }
}

export default getters