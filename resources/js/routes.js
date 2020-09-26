import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);
// import ExampleComponent from "./components/ExampleComponent";
import Home from "./views/Home"
import About from "./views/About"
import Archive from "./views/Archive"
import Contact from "./views/Contact"
import View404 from "./views/View404"
import PostsShow from "./views/PostsShow"
import CategoryPosts from "./views/CategoryPosts"
import TagsPosts from "./views/TagsPosts"
export default new Router({
    routes: [
        {
            name: 'home',
            path: '/',
            component: Home,
        },
        {
            name: 'about',
            path: '/nosotros',
            component: About,
        },
        {
            path: '/archivo',
            name: 'archive',
            component: Archive,
        },
        {
            path: '/contacto',
            name: 'contact',
            component: Contact,
        },
        {
            path: '/blog/:url',
            name: 'posts_show',
            component: PostsShow,
            props: true,
        },
        {
            path: '/categorias/:category',
            name: 'category_posts',
            component: CategoryPosts,
            props: true,
        },
        {
            path: '/etiquetas/:tag',
            name: 'tags_posts',
            component: TagsPosts,
            props: true,
        },
        {
            path: '*',
            component: View404,
        }
    ],
    linkExactActiveClass: 'active',
    // linkActiveClass: 'active-route',
    scrollBehavior() {
        return { x:0, y:0 };
    },
    mode: 'history',
});
