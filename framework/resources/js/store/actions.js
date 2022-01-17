let actions = {
    getPHPInfo({ commit }) {
        axios.get('/api/phpinfo')
            .then(res => {
                commit('GET_PHPINFO', res.data)
            }).catch(err => {
                console.log(err)
            })
    }
}

export default actions