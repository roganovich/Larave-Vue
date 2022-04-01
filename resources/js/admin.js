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
    render: ()=>h(App),
    /*mounted() {
        this.getUser()
    },
    provide:{
        auth: {},
    },*/
    methods: {
        /*getUser() {
            let app = this;
            axios.get('/api/v1/users/curent/')
                .then(function (resp) {
                    app.auth = resp.data;
                })
                .catch(function () {
                    alert("Не смог получить данные")
                });
        }*/
    }
})

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

app.use(router)
app.mount('#admin')

