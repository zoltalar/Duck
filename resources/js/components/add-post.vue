<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <div ref="mapContainer"></div>
                <template v-if="Boolean(this.google) && Boolean(this.map)">
                    <slot :google="google" :map="map"></slot>
                </template>
            </div>
            <div class="col-sm-6">2</div>
        </div>
    </div>
</template>
<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader'

    export default {
        name: 'add-post',
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
        }
    }
</script>