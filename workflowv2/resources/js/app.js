/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import db from './db';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(BootstrapVue)
Vue.use(VueToast);

Vue.component('login', require('./components/Login.vue').default);
Vue.component('register-freelancer', require('./components/registerFreelancer.vue').default);
Vue.component('register-employer', require('./components/registerEmployer.vue').default);
Vue.component('register-coordinator', require('./components/RegisterCoordinator.vue').default);

Vue.component('float-messenger', require('./components/floatingMessenger.vue').default);

Vue.component('create-job', require('./components/employer/CreateJob.vue').default);
Vue.component('job-posted', require('./components/employer/jobPosted.vue').default);
Vue.component('job-single-employer', require('./components/employer/jobSingle.vue').default);
Vue.component('room', require('./components/employer/Room.vue').default);
Vue.component('e-chat', require('./components/employer/chatRoom.vue').default);

Vue.component('invites', require('./components/freelancer/jobInvites.vue').default);
Vue.component('job-freelancer', require('./components/freelancer/jobList.vue').default);
Vue.component('my-job-list', require('./components/freelancer/myJobList.vue').default);
Vue.component('f-chat', require('./components/freelancer/chatRoom.vue').default);

Vue.component('jobs-coordinator', require('./components/coordinator/myJobs.vue').default);
Vue.component('jobs-invitaion', require('./components/coordinator/application.vue').default);
Vue.component('coor-room', require('./components/coordinator/room.vue').default);
Vue.component('c-chat', require('./components/coordinator/chatRoom.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin({
    methods: {
        test(){
            alert('fire mixin');
        }
    }
})
const app = new Vue({
    el: '#app',
});
