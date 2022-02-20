import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from './components/pages/Home';
import About from './components/pages/About';
import Contacts from './components/pages/Contacts';
import Posts from './components/pages/Posts';
import PostDetail from './components/pages/PostDetail';
import Error404 from './components/pages/Error404';

const router = new VueRouter({
    mode: 'history',

    linkExactActiveClass: 'active',
    routes:[
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/posts',
            name: 'posts',
            component: Posts        
        },
        {
            path: '/detail/:slug',
            name: 'detail',
            component: PostDetail        
        },
        {
            path: '*',
            component: Error404        
        },
    ]
});

export default router;