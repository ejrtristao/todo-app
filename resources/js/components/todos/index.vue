<script setup>
import { onMounted, ref, inject } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

let todos = ref([]);
let isAuthenticated = ref(false);
let cookies = inject("cookies");

onMounted(async () => {
    getTodos();
    checkLogin();
    console.log("mounted");
});

const checkLogin = () => {
    if (cookies.get("token") === null) {
        isAuthenticated.value = false;
    } else {
        isAuthenticated.value = true;
    }
};

const getTodos = async () => {
    const response = await axios.get("/api/todos");
    todos.value = response.data;
};

const completedTodo = async (id) => {
    const response = await axios
        .put("/api/todos/completed/" + id)
        .then((response) => {
            getTodos();
        })
        .catch((error) => {
            console.log(error);
        });
};

const createTodo = () => {
    router.push("/todos/create");
};

const login = () => {
    router.push("/login");
};

const logout = () => {
    cookies.set("token", "");
    isAuthenticated.value = false;
};

const editTodo = (id) => {
    router.push("/todos/edit/" + id);
};

const deleteTodo = async (id) => {
    const response = await axios
        .delete("/api/todos/" + id)
        .then((response) => {
            getTodos();
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <div class="container bg-white">
        <div class="row" v-if="isAuthenticated">
            <div class="col-md-12">
                <h1>Tarefas</h1>
            </div>
            <div class="col-md-12">
                <button @click="createTodo">Nova Tarefa</button>
                <button @click="logout">Logout</button>
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
                            <td>{{ todo.id }}</td>
                            <td>{{ todo.todo }}</td>
                            <td>{{ todo.status }}</td>
                            <td>
                                <button
                                    class="btn btn-primary"
                                    @click="editTodo(todo.id)"
                                >
                                    Editar
                                </button>
                                <button
                                    class="btn btn-danger"
                                    @click="deleteTodo(todo.id)"
                                >
                                    Excluir
                                </button>
                                <button
                                    class="btn btn-danger"
                                    @click="completedTodo(todo.id)"
                                >
                                    Completar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" v-else>
            <div class="col-md-12">
                <h1>Acesso</h1>
                <button @click="login">Login</button>
            </div>
        </div>
    </div>
</template>
