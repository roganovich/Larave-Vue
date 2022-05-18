/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp,h } from "vue";

import { createRouter, createWebHistory } from 'vue-router';
import App from '../../vue/App.vue';
import { createI18n, useI18n } from 'vue-i18n'
import {routes} from '../../vue/routes';

const i18n = createI18n({
    legacy: false,
    locale: 'ru',
    globalInjection: true,
    messages: loadLocaleMessages(),
})

function loadLocaleMessages() {
    const locales = require.context(
        '../../lang/',
        true,
        /[A-Za-z0-9-_,\s]+\.json$/i
    );
    //console.log('locales',locales);
    const messages = {};
    locales.keys().forEach((key) => {
        const matched = key.match(/([A-Za-z0-9-_]+)\./i);
        if (matched && matched.length > 1) {
            const locale = matched[1];
            messages[locale] = locales(key);
        }
    });
    //console.log('messages',messages);
    return messages;
}

const app = createApp({
    render: ()=>h(App),
    i18n
})

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})
app.use(i18n)
app.use(router)
app.mount('#admin')

