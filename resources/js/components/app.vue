<template>
    <div id="root">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="/" class="navbar-brand">Duck</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-primary">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link :to="{ name: 'add-post' }" class="nav-link">Add Post</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="pt-5">
            <router-view></router-view>
        </div>
    </div>
</template>