<template>
    <div class="justify-content-center">
        <b-table striped hover outlined :items="users" :per-page="perPage" :current-page="currentPage" :fields="fields">

            <template v-slot:cell(actions)="data">
                <b-button variant="primary" @click="updateItem(data.item.id)">Update</b-button>
            </template>

        </b-table>
        <div class="row justify-content-center">

                <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                ></b-pagination>
        </div>
    </div>
</template>

<script>
    import VueCookie from "vue-cookie";

    export default {
        components: { VueCookie},
        data() {
            return {
                fields: ["id", "name", "email", "date_of_birth", "actions"],
                users: [],
                perPage: 10,
                currentPage: 1,
            };
        },
        computed: {
            rows() {
                return this.users.length;
            },
        },
        mounted() {
            var api_access_token = VueCookie.get('API_ACCESS_TOKEN');
            this.headers = {'Authorization': 'Bearer ' + api_access_token, 'Accept': 'application/json'};

            this.loadData();
        },
        methods: {
            loadData: function() {
                this.$toast.info("Fetching users");
                let url = '/api/users';
                axios.get(url, {headers: this.headers}).then(res => {
                    this.$toast.success("Got users data")
                    console.log(res.data);
                    this.users = res.data.data;
                }).catch(e => {
                    this.$toast.error('Something went wrong fetching the user, please try again later');
                });
            },
            updateItem: function(id) {
                window.location.href = '/users/' + id + '/update';
            }
        }
    }
</script>
