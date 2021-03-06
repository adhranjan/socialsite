
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=_token]').attr('content');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('init', require('./components/Init.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('unreadnotification', require('./components/UnreadNotification.vue'));
Vue.component('friendship', require('./components/Friendship.vue'));
Vue.component('myprofile', require('./components/MyProfile.vue'));
Vue.component('createpost', require('./components/Createpost.vue'));
Vue.component('wallpost', require('./components/Wallpost.vue'));
Vue.component('wallfeed', require('./components/WallFeed.vue'));
Vue.component('feed', require('./components/Feed.vue'));
Vue.component('like', require('./components/Like.vue'));

import {store} from './store'

const app = new Vue({
    el: '#app',
    store
});
