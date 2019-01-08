<template>
    <div class="row">
        <div class="col-sm-6 col-md-4 offset-sm-3 offset-md-4">
            <form>
                <h3 class="mb-3">Login</h3>
                <div class="alert alert-danger text-center" v-show="error">Invalid login credentials</div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" maxlength="191" v-model="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" maxlength="40" v-model="password">
                </div>
                <div>
                    <button type="button" class="btn btn-lg btn-primary btn-block" @click="login()" :disabled="!validated()">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                error: false,
                email: '',
                password: ''
            }
        },
        methods: {
            login() {
                axios
                    .post('/api/auth/login', {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        if (response.data.error) {
                            this.error = true
                        } else {
                            this.error = false
                            this.$store.dispatch('login', response.data)
                        }
                    });
            },
            validated() {
                return this.email !== '' && this.password !== ''
            }
        }
    }
</script>