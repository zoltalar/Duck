<template>
    <div id="root">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link :to="{ name: 'home' }" class="navbar-brand">Duck</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-primary">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'register' }" class="nav-link" v-show="loggedIn() === false">Register</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'login' }" class="nav-link" v-show="loggedIn() === false">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'add-post' }" class="nav-link">Add Post</router-link>
                    </li>
                    <li class="nav-item" v-show="loggedIn() === true">
                        <a href="#" class="nav-link" @click="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="pt-5">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {
        methods: {
            logout() {
                this.$store.dispatch('logout')
            },
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        }
    }
</script>