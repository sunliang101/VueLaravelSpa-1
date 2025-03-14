import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import HeaderComponent from "./components/HeaderComponent";
import TaskListComponent from "./components/TaskListComponent";
import TaskCreateComponent from "./components/TaskCreateComponent";
import TaskShowComponent from "./components/TaskShowComponent";
import TaskEditComponent from "./components/TaskEditComponent";
import ContentsComponent from "./components/ContentsComponent";
import Cal from "./components/Cal";
import form from "./components/form";
import list from "./components/list";
import list2 from "./components/list2";

import App from './App.vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/contents/',
            name: 'contents',
            component: ContentsComponent
        },

        {
            path: '/cal',
            name: 'cal',
            component: Cal
        },

        
        {
            path: '/form',
            name: 'form',
            component: form,
            props:true
        },

        {
            path: '/list',
            name: 'list',
            component: list
        },

        {
            path: '/list2',
            name: 'list2',
            component: list2
        },

        {
            path: '/tasks',
            name: 'task.list',
            component: TaskListComponent
        },
        {
            path: '/tasks/create',
            name: 'task.create',
            component: TaskCreateComponent
        },
        {
            path: '/tasks/:taskId',
            name: 'task.show',
            component: TaskShowComponent,
            props: true
        },
        {
            path: '/tasks/:taskId/edit',
            name: 'task.edit',
            component: TaskEditComponent,
            props: true
        },

        {
            path: '/contents/:taskId',
            name: 'content.edit',
            component: TaskShowComponent,
            props: true
        },
    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('header-component', HeaderComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App />',
    vuetify: new Vuetify({
        iconfont: 'mdi', 
    }),
    router
});
