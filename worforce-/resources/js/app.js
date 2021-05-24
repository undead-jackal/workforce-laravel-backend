/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import { BootstrapVue } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('job-list-emp', require('./components/employer/employerMain.vue').default);
Vue.component('manage-applicants-vue', require('./components/employer/applicants.vue').default);
Vue.component('manage-main-vue', require('./components/employer/manage.vue').default);
Vue.component('manage-employee', require('./components/employer/employee.vue').default);
Vue.component('manage-interview', require('./components/employer/interview.vue').default);
Vue.component('manage-jobdetail-vue', require('./components/employer/jobDetail.vue').default);
Vue.component('profile-employer', require('./components/employer/profile.vue').default);
Vue.component('emp-wallet-vue', require('./components/employer/wallet.vue').default);

Vue.component('login', require('./components/employer/login.vue').default);
Vue.component('register', require('./components/employer/register.vue').default);

Vue.component('j-modal', require('./components/reusable/jModal.vue').default);
Vue.component('side-nav', require('./components/reusable/sidenav.vue').default)
Vue.component('top-nav', require('./components/reusable/topnav.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */ 

const app = new Vue({
    el: '#app',
});
