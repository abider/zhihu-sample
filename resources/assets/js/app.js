
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('question-follow', require('./components/questions/Follow.vue'));
Vue.component('user-follow', require('./components/users/Follow.vue'));
Vue.component('answer-vote', require('./components/answers/Vote.vue'));
Vue.component('send-message', require('./components/users/SendMessage.vue'));
Vue.component('comments', require('./components/comments/Index.vue'));

const app = new Vue({
    el: '#app'
});
