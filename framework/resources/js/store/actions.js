let actions = {
    getPHPInfo({ commit }) {
        axios
            .get("/api/phpinfo")
            .then((res) => {
                commit("GET_PHPINFO", res.data);
            })
            .catch((err) => {
                console.log(err);
            });
    },
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
    },
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

export default actions;
