import { createRouter, createWebHistory } from 'vue-router';

import todos from '../components/todos/index.vue';
import createTodo from '../components/todos/create.vue';
import editTodo from '../components/todos/edit.vue';
import notFound from '../components/notFound.vue';

const routes = [
    { path: '/', component: todos },
    { path: '/todos/create', component: createTodo },
    { path: '/todos/edit/:id', component: editTodo, props: true },
    // { path: '/:pathMath(.*)*', component: notFound }, 
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default router;