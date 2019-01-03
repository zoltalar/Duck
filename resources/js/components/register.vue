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
                    <div class="invalid-feedback" v-show="error.name !== ''" :class="{ 'd-block': error.name !== '' }">
                        {{ error.name }}
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-mail Address" maxlength="191" v-model="email">
                    <div class="invalid-feedback" v-show="error.email !== ''" :class="{ 'd-block': error.email !== '' }">
                        {{ error.email }}
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" maxlength="40" v-model="password">
                    <div class="invalid-feedback" v-show="error.password !== ''" :class="{ 'd-block': error.password !== '' }">
                        {{ error.password }}
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
                error: {
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
                        this.reset()

                        if (response.data.error) {
                            for (let property in response.data.error) {
                                if (response.data.error[property][0]) {
                                    this.error[property] = response.data.error[property][0]
                                }
                            }
                        } else {
                            this.registered = true
                        }
                    })
            },
            validated() {
                return this.name !== '' && this.email !== '' && this.password !== ''
            },
            reset() {
                this.error = {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        }
    }
</script>