import { createRouter, createWebHistory } from 'vue-router';

import todos from '../components/todos/index.vue';
import notFound from '../components/notFound.vue';

const routes = [
    { path: '/', component: todos },
    { path: '/todos', component: todos }    
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default router;