<template>
    <google-map-loader :map-config="mapConfig" api-key="{{ env('GOOGLE_MAPS_API_KEY') }}">
        <template slot-scope="{ google, map }">
            {{ map }}
            {{ google }}
        </template>
    </google-map-loader>
</template>
<script>
    import GoogleMapLoader from './components/google-map-loader'

    export default {
        components: {
            GoogleMapLoader
        },
        computed: {
            mapConfig() {
                return {
                    zoom: 12,
                    center: { lat: 0, lng: 0 }
                }
            }
        }
    }
</script>