<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <div ref="mapContainer" class="h-500"></div>
            </div>
            <div class="col-sm-6">
                <h5 class="mb-3">Location of the Yellow Duck</h5>
                <address>
                    <p class="mb-0">Latitude: 0.00</p>
                    <p class="mb-0">Longitude: 0.00</p>
                </address>
                <form>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="input-photo">
                        <label class="custom-file-label" for="input-photo">Choose Image</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'add-post',
        data() {
            return {
                map: null,
                marker: null
            }
        },
        mounted() {
            google.maps.event.addDomListener(window, 'load', this.initialize)
        },
        methods: {
            setMarker(location) {
                if (this.marker !== null) {
                    this.marker.setMap(null)
                }

                this.marker = new google.maps.Marker({
                    position: location,
                    map: this.map
                })
            },
            initialize() {
                let container = this.$refs.mapContainer

                let warsaw = {
                    lat: 52.23,
                    lng: 20.78
                }

                let options = {
                    zoom: 10,
                    center: warsaw
                }

                this.map = new google.maps.Map(container, options)

                this.map.addListener('click', (event) => {
                    this.setMarker(event.latLng)
                })

                this.setMarker(warsaw)
            }
        }
    }
</script>