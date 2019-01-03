<template>
    <div>
        <div class="row">
            <div class="col-sm-7">
                <div ref="mapContainer" class="h-500"></div>
            </div>
            <div class="col-sm-5">
                <div class="alert alert-success" v-show="posted">
                    Entry added successfully.
                    <router-link :to="{ name: 'home' }">Home</router-link>
                </div>
                <div v-show="!posted">
                    <h5 class="mb-3">Location of the Yellow Duck</h5>
                    <mark class="d-inline-block p-2 mb-3" v-show="Boolean(this.latitude) && Boolean(this.latitude)">&lt;{{ latitude }}, {{ longitude}}&gt;</mark>
                    <form>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="input-photo" accept="image/*" @change="preview($event)">
                                <label class="custom-file-label" for="input-photo">Choose Photo</label>
                            </div>
                            <div class="invalid-feedback" v-show="errors.photo !== ''" :class="{ 'd-block': errors.photo !== '' }">
                                {{ errors.photo }}
                            </div>
                        </div>
                        <div class="form-group" v-show="photo !== ''">
                            <img :src="photo" class="img-fluid">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-default float-right" @click="reset()" v-show="validated()">Cancel</button>
                            <button type="button" class="btn btn-primary" @click="submit()" :disabled="!validated()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import router from '../router'

    export default {
        name: 'add-post',
        data() {
            return {
                map: null,
                marker: null,
                latitude: null,
                longitude: null,
                warsaw: {
                    lat: 52.22500222565406,
                    lng: 21.01116439483155
                },
                photo: '',
                errors: {
                    photo: ''
                },
                posted: false
            }
        },
        mounted() {
            this.initialize()
        },
        methods: {
            initialize() {
                let container = this.$refs.mapContainer

                let options = {
                    zoom: 10,
                    center: this.warsaw
                }

                this.map = new google.maps.Map(container, options)

                this.map.addListener('click', (event) => {
                    this.setMarker(event.latLng)
                })

                this.setMarker(this.warsaw)
            },
            setMarker(location) {
                if (this.marker !== null) {
                    this.marker.setMap(null)
                }

                this.marker = new google.maps.Marker({
                    position: location,
                    map: this.map
                })

                if (typeof location.lat === 'function') {
                    this.latitude = location.lat()
                } else {
                    this.latitude = location.lat
                }

                if (typeof location.lng === 'function') {
                    this.longitude = location.lng()
                } else {
                    this.longitude = location.lng
                }
            },
            clearErrors() {
                this.errors = {
                    photo: ''
                }
            },
            setErrors(response) {
                if (response.data.errors) {
                    for (let property in response.data.errors) {
                        if (response.data.errors[property][0]) {
                            this.errors[property] = response.data.errors[property][0]
                        }
                    }
                }
            },
            submit() {
                axios.defaults.headers.post['Content-Type'] = 'multipart/form-data'

                axios
                    .post('/api/posts/store', {
                        latitude: this.latitude,
                        longitude: this.longitude,
                        photo: this.photo
                    })
                    .then(response => {
                        this.clearErrors()
                        this.setErrors(response)

                        if (response.data.data.id) {
                            this.posted = true;
                            this.reset()

                            setTimeout(() => {
                                router.push({ name: 'home' })
                            }, 5000)
                        }
                    })
                    .catch(error => {
                        this.clearErrors()
                        this.setErrors(error.response)
                    })
            },
            preview(event) {
                let files = event.target.files

                if (files[0]) {
                    let reader = new FileReader()

                    reader.onload = event => {
                        this.photo = event.target.result
                    }

                    reader.readAsDataURL(files[0])
                }
            },
            validated() {
                return (
                    this.latitude !== null &&
                    this.longitude !== null &&
                    this.photo !== ''
                )
            },
            reset() {
                this.setMarker(this.warsaw)
                this.photo = '';
            }
        }
    }
</script>