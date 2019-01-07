<template>
    <div>
        <h3 class="mb-4">Posts</h3>
        <div class="row">
            <div class="col-sm-3" v-for="post in posts">
                <div class="card">
                    <img class="card-img-top">
                    <div class="card-body">
                        <mark class="small">&lt;{{ post.latitude }}, {{ post.longitude }}&gt;</mark>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'posts',
        data() {
            return {
                posts: []
            }
        },
        methods: {
            load() {
                axios
                    .get('/api/posts/index')
                    .then(response => {
                        this.posts = response.data.data
                    })
            }
        },
        mounted() {
            this.load()
        }
    }
</script>