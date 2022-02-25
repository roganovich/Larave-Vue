/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp,h } from "vue";
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import {routes} from './routes';

const app = createApp({
    render: ()=>h(App)
})

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

app.use(router)
app.mount('#admin')

