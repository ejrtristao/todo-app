require('./bootstrap');

import { createApp } from 'vue';
import VueCookie from 'vue-cookies';

import router from './router';

import App from './components/App';

const app = createApp(App);
app.use(VueCookie);
app.provide('cookies', app.config.globalProperties.$cookies);
app.use(router);
app.mount('#app');
