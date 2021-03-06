/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



Vue.component('home-component', require('./components/HomeComponent.vue').default);

Vue.component('user-component', require('./components/UserComponent.vue').default);

Vue.component('searchfriend-component', require('./components/searchFriendComponent.vue').default);


//mmenu 

Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('serach-friend', require('./components/SerachFriend.vue').default);

Vue.component('chat', require('./components/Chat.vue').default);
Vue.component('createArticle', require('./components/CreateArticle.vue').default);

Vue.component('Comment', require('./components/Comment.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
