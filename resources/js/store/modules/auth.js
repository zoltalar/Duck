import router from '../../router'

export default {
    state: {
        loggedIn: false
    },
    mutations: {
        login(state) {
            state.loggedIn = true
        },
        logout(state) {
            state.loggedIn = false
        }
    },
    getters: {
        loggedIn: state => state.loggedIn
    },
    actions: {
        login({ commit }, data) {
            commit('login')
            window.localStorage.setItem('accessToken', data.access_token)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.access_token

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