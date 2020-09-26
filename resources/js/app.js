/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import router from './routes';

require('vue2-animate/dist/vue2-animate.min.css');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('post-header', require('./components/PostHeader').default);
Vue.component('posts-list', require('./components/PostsList').default);
Vue.component('posts-list-item', require('./components/PostListItem').default);
Vue.component('nav-bar', require('./components/NavBar').default);
Vue.component('category-link', require('./components/CategoryLink').default);
Vue.component('tag-link', require('./components/TagLink').default);
Vue.component('post-link', require('./components/PostLink').default);
Vue.component('disqus-comments', require('./components/DisqusComments').default);
Vue.component('pagination-links', require('./components/PaginationLinks').default);
Vue.component('paginator', require('./components/Paginator').default);
Vue.component('social-links', require('./components/SocialLinks').default);
Vue.component('contact-form', require('./components/ContactForm').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});

