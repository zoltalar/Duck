<template>
    <div>
        <h3 class="mb-4">Posts</h3>
        <p class="mb-0" v-show="posts.length == 0">There are no posts to display</p>
        <div class="row" v-show="posts.length > 0">
            <div class="col-md-4" v-for="(post, i) in posts">
                <div class="card">
                    <img class="card-img-top" alt="Duck" :src="post.photo">
                    <div class="card-body">
                        <mark class="small">&lt;{{ post.latitude }}, {{ post.longitude }}&gt;</mark>
                        <p class="mt-2 mb-0">
                            <a href="#" class="card-link" @click="disapprove(post.id, i)" v-if="Number(post.active) == 1">Disapprove</a>
                            <a href="#" class="card-link" @click="approve(post.id, i)" v-else>Approve</a>
                            <a href="#" class="card-link" @click="destroy(post.id)">Delete</a>
                        </p>
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
            },
            approve(id, i) {
                axios
                    .get('/api/posts/approve/' + id)
                    .then(response => {
                        this.posts[i].active = 1
                    })
            },
            disapprove(id, i) {
                axios
                    .get('/api/posts/disapprove/' + id)
                    .then(response => {
                        this.posts[i].active = 0
                    })
            },
            destroy(id) {
                if (confirm('Are you sure?')) {
                    axios
                        .post('/api/posts/destroy/' + id)
                        .then(response => {
                            this.posts = this.posts.filter(item => item.id != id)
                        })
                }
            }
        },
        mounted() {
            this.load()
        }
    }
</script>