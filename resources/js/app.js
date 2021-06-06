/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { TablePlugin } from 'bootstrap-vue'

//import css files
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(TablePlugin);
Vue.use(require('vue-cookie'));
Vue.use(require('vuejs-datepicker'));
Vue.use(require('vue-resource'));
import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
const options = {
    position: POSITION.TOP_RIGHT,
    timeout: 3000
};
Vue.use(Toast, options);


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = token.content;
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('auth-login', require('./components/auth/LoginComponent.vue').default);

Vue.component('store-user', require('./components/users/CreateUserComponent.vue').default);
Vue.component('list-users', require('./components/users/ListUsersComponent.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
