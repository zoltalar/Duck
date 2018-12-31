<template>
    <div>
        <div class="google-map" ref="mapContainer"></div>
        <template v-if="Boolean(this.google) && Boolean(this.map)">
            <slot :google="google" :map="map"></slot>
        </template>
    </div>
</template>
<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader'

    export default {
        name: 'google-map-loader',
        props: {
            mapConfig: Object,
            apiKey: String
        },
        data() {
            return {
                google: null,
                map: null
            }
        },
        async mounted() {
            const googleMapsApi = await GoogleMapsApiLoader({
                apiKey: this.apiKey
            })

            this.google = googleMapsApi
            this.initMap()
        },
        methods: {
            initMap() {
                const container = this.$refs.mapContainer
                this.map = new this.google.maps.Map(container, this.mapConfig)
            }
        }
    }
</script>