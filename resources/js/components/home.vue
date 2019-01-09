<template>
    <div>
        <h3 class="mb-4">Locations of the Yellow Duck</h3>
        <div ref="mapContainer" class="h-500"></div>
    </div>
</template>
<script>
    export default {
        name: 'home',
        data() {
            return {
                map: null,
                warsaw: {
                    lat: 52.22500222565406,
                    lng: 21.01116439483155
                },
                posts: []
            }
        },
        methods: {
            init() {
                let container = this.$refs.mapContainer

                let options = {
                    zoom: 5,
                    center: this.warsaw
                }

                this.map = new google.maps.Map(container, options)
            },
            load() {
                axios
                    .get('/api/posts/index')
                    .then(response => {
                        this.posts = response.data.data.filter(item => Number(item.active) == 1)
                    })
            }
        },
        watch: {
            posts: {
                handler(newVal, oldVal) {
                    this.posts.forEach((post) => {
                        let marker = new google.maps.Marker({
                            position: new google.maps.LatLng(post.latitude, post.longitude),
                            map: this.map
                        })

                        let html = '<img src="' + post.photo + '">'

                        let infoWindow = new google.maps.InfoWindow({
                            content: html
                        })

                        marker.addListener('click', () => {
                            infoWindow.open(this.map, marker)
                        })
                    })
                },
                deep: true
            }
        },
        mounted() {
            this.init()
            this.load()
        }
    }
</script>