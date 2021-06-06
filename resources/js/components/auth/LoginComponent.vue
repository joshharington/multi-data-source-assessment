<template>
    <div>
        <form method="POST" id="form_login">
            <input type="hidden" name="_token" v-model="csrf" />

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                <div class="col-md-6">
                    <input v-model="email" id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-6">
                    <input v-model="password" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="button" @click="submit" class="btn btn-primary">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import VueCookie from 'vue-cookie';

    export default {
        components: { VueCookie },
        data() {
            return {
                messages: [],
                csrf: '',
                remember_me: false,
                email: '',
                password: '',
                error: false,
                in_processing: false
            };
        },
        mounted() {
            this.csrf = $('meta[name="csrf-token"]')[0].content;
        },
        methods: {
            submit: function() {
                this.messages = [];
                if (this.email.length == 0 || this.password.length == 0) {
                    this.error = true;
                    this.$toast.error('Email and password are required');
                    return;
                }

                this.$toast.info('Submitting login');

                this.error = false;
                this.in_processing = true;
                var self = this;
                axios.post('/oauth/token', {
                    username: this.email,
                    password: this.password,
                    client_id: 2,
                    client_secret: 'eQqTps21vZNgsvxflflIsW1gvVaFAXmxizEiCgvY',
                    grant_type: 'password',
                    scope: '*'
                }).then(response => {
                    console.log(response);
                    if(response.data.hasOwnProperty('access_token')) {
                        var access_token = response.data.access_token;
                        VueCookie.set('API_ACCESS_TOKEN', response.data.access_token);
                        this.$toast.success('Login successful, redirecting');
                        $('#form_login').submit();
                    }
                }).catch(e => {
                    self.in_processing = false;
                    self.error = true;
                    self.$toast.error('User credentials were incorrect');
                })
            }
        }
    }
</script>
