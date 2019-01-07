import router from '../../router'

export default {
    state: {
        loggedIn: false,
        user: null
    },
    mutations: {
        login(state, response) {
            state.loggedIn = true
            state.user = response.user
        },
        logout(state) {
            state.loggedIn = false
            state.user = null
        }
    },
    getters: {
        loggedIn: state => state.loggedIn,
        user: state => state.user
    },
    actions: {
        login({ commit }, response) {
            commit('login', response)
            window.localStorage.setItem('accessToken', response.access_token)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.access_token

            router.push({ name: 'home' })
        },
        logout({ commit }) {
            commit('logout')
            window.localStorage.removeItem('accessToken')
            delete axios.defaults.headers.common['Authorization']

            router.push({ name: 'home' })
        }
    }
}