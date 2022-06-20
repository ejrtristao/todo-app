<script setup>

import {onMounted, ref} from 'vue'; 
import { useRouter } from 'vue-router';

const router = useRouter();

let todos = ref([]);

onMounted(async() => {
    getTodos();
    console.log('mounted');
});

const getTodos = async() => {
    const response = await axios.get('/api/todos');
    todos.value = response.data;
};

const completedTodo = async(id) => {
    const response = await axios.put('/api/todos/completed/' + id)
    .then(response => {
        getTodos();
    })
    .catch(error => {
        console.log(error);
    });    
};

const createTodo = () => {
    router.push('/todos/create');
};

const editTodo = (id) => {
    router.push('/todos/edit/'+id);
};

</script>

<template>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-12">
                <h1>Tarefas</h1>
            </div>
            <div class="col-md-12">
                <button @click="createTodo">Nova Tarefa</button>
            </div>
        </div>
        <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tarefa</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="todo in todos" :key="todo.id">
                    <td>{{todo.id}}</td>
                    <td>{{todo.todo}}</td>
                    <td>{{todo.status}}</td>
                    <td>
                        <button class="btn btn-primary" @click="editTodo(todo.id)">Editar</button>
                        <button class="btn btn-danger" @click="deleteTodo(todo.id)">Excluir</button>
                        <button class="btn btn-danger" @click="completedTodo(todo.id)">Completar</button>
                    </td>
                </tr>
                </tbody>
        </table>
        </div>
    </div>
</template>
