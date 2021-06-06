<template>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Name</label>
                <input v-model="name" type="text" name="name" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input v-model="email" type="email" name="email" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Date of Birth</label>
                <datepicker v-model="date_of_birth" input-class="form-control"></datepicker>
            </div>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <div class="form-group">
                <div class="float-right">
                    <button type="button" @click="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueCookie from 'vue-cookie';
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: { VueCookie, Datepicker },
        props: ['user_id'],
        data() {
            return {
                email: '',
                name: '',
                date_of_birth: '',
            };
        },
        mounted() {
            console.log('Component mounted.');

            var api_access_token = VueCookie.get('API_ACCESS_TOKEN');
            this.headers = {'Authorization': 'Bearer ' + api_access_token, 'Accept': 'application/json'};

            if(this.user_id != null) {
                // User ID - edit user
                this.loadData();
            }
        },
        methods: {
            loadData: function() {
                this.$toast.info("Fetching user data");
                let url = '/api/users/' + this.user_id;
                axios.get(url, {headers: this.headers}).then(res => {
                    this.$toast.success("Got user data")
                    let data = res.data.data;
                    if(data.hasOwnProperty('id') && data.hasOwnProperty('name')) {
                        this.name = data.name;
                        this.email = data.email;
                        this.date_of_birth = data.date_of_birth;
                    }
                }).catch(e => {
                    this.$toast.error('Something went wrong fetching the user, please try again later');
                });
            },
            submit: function() {
                // Validate input
                if(this.email == '' || this.name == '') {
                    this.$toast.error('Name and email fields are required');
                    return;
                }

                let data = {
                    "name": this.name,
                    "email": this.email,
                    "date_of_birth": this.date_of_birth,
                    "user_id": this.user_id
                };

                this.$toast.info('Submitting user data');

                if(this.user_id != null) {
                    // Update user
                    let url = '/api/users/' + this.user_id;
                    axios.put(url, data, {headers: this.headers}).then(response => {
                        this.$toast.success('User updated successfully.');
                        window.location.href = '/users';
                    }).catch(e => {
                        this.$toast.error(e.response.data.data.message);
                    });

                } else {
                    // Create user
                    axios.post('/api/users', data, {headers: this.headers}).then(response => {
                        this.$toast.success('User created successfully.');
                        window.location.href = '/users';
                    }).catch(e => {
                        this.$toast.error(e.response.data.data.message);
                    });
                }
            },
        }
    }
</script>
