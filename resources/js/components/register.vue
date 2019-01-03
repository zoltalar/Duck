<template>
    <div class="row">
        <div class="col-sm-6 col-md-4 offset-sm-3 offset-md-4">
            <div class="alert alert-info" v-show="registered">
                Registration successful.
                <router-link :to="{ name: 'login' }">Login</router-link>
            </div>
            <form autocomplete="off" v-show="!registered">
                <h3 class="mb-3">Register</h3>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" maxlength="191" v-model="name">
                    <div class="invalid-feedback" v-show="errors.name !== ''" :class="{ 'd-block': errors.errors !== '' }">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" maxlength="191" v-model="email">
                    <div class="invalid-feedback" v-show="errors.email !== ''" :class="{ 'd-block': errors.email !== '' }">
                        {{ errors.email }}
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" maxlength="40" v-model="password">
                    <div class="invalid-feedback" v-show="errors.password !== ''" :class="{ 'd-block': errors.password !== '' }">
                        {{ errors.password }}
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-lg btn-primary btn-block" @click="register()" :disabled="!validated()">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                errors: {
                    name: '',
                    email: '',
                    password: ''
                },
                registered: false
            }
        },
        methods: {
            register() {
                axios
                    .post('/api/auth/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        this.clearErrors()
                        this.setErrors(response)

                        if (response.data.data.id) {
                            this.registered = true
                        }
                    })
                    .catch(error => {
                        this.clearErrors()
                        this.setErrors(error.response)
                    })
            },
            clearErrors() {
                this.errors = {
                    name: '',
                    email: '',
                    password: ''
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
            validated() {
                return this.name !== '' && this.email !== '' && this.password !== ''
            }
        }
    }
</script>