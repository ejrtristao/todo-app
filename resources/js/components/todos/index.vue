<script setup>
import { onMounted, ref, inject } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

let todos = ref([]);
let isAuthenticated = ref(false);
let cookies = inject("cookies");

onMounted(async () => {
    checkLogin();
});

const checkLogin = () => {
    if (cookies.get("token") === null) {
        isAuthenticated.value = false;
    } else {
        isAuthenticated.value = true;
        getTodos();
    }
};

const getTodos = async () => {
    const response = await axios.get("/api/todos", {
        headers: {
            Authorization: `Bearer ${cookies.get("token") }`
        }
    });
    todos.value = response.data;
};

const completedTodo = async (id) => {
    const response = await axios
        .put("/api/todos/completed/" + id, {
        headers: {
            Authorization: `Bearer ${cookies.get("token") }`
        }
    })
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
    <div class="container">
        <div class="row" v-if="isAuthenticated">
            <div class="container">
                <div class="row">
                    <div class="col-auto me-auto">
                        <h1>Tarefas</h1>
                        <button
                            class="btn btn-sm btn-primary float-right"
                            @click="createTodo"
                        >
                            Nova Tarefa
                        </button>
                    </div>
                    <div class="col-auto">
                        <button
                            class="btn btn-sm btn-secondary"
                            @click="logout"
                        >
                            Sair
                        </button>
                    </div>
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
                            <td>{{ todo.id }}</td>
                            <td>{{ todo.todo }}</td>
                            <td>{{ todo.status }}</td>
                            <td>
                                <div
                                    class="btn-group"
                                    role="group"
                                    v-show="todo.status === 'pending'"
                                >
                                    <button
                                        class="btn btn-primary"
                                        @click="editTodo(todo.id)"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        class="btn btn-success"
                                        @click="completedTodo(todo.id)"
                                    >
                                        Completar
                                    </button>

                                    <button
                                        class="btn btn-danger"
                                        @click="deleteTodo(todo.id)"
                                    >
                                        Excluir
                                    </button>
                                </div>
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
