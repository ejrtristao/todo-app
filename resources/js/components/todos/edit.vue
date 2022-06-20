<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

let form = ref({
    todo: "",
    description: "",
    user_id: "",
});

onMounted(async () => {
    getTodo();
});

const props = defineProps({
    id: {
        type: String,
        default: "",
    },
});

const router = useRouter();

const getTodo = async () => {
    const response = await axios.get(`/api/todos/${props.id}`);
    form.value = response.data;
};

const updateTodo = () => {
    const headers = {
        "Content-Type": "application/x-www-form-urlencoded",
    };

    const formData = new FormData();
    formData.append("todo", form.value.todo);
    formData.append("description", form.value.description);
    formData.append("user_id", form.value.user_id);
    formData.append("_method", "PUT");

    axios
        .post(`/api/todos/${props.id}`, formData, headers)
        .then((response) => {
            router.push("/");
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>

<template>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-12">
                <h1>Editar Tarefa</h1>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="todo">Tarefa</label>
                    <input'
                        type="text"
                        class="form-control"
                        id="todo"
                        v-model="form.todo"
                    />
                    <label for="description">Descrição</label>
                    <input
                        type="text"
                        class="form-control"
                        id="description"
                        v-model="form.description"
                    />
                </div>

                <div class="btn-group">
                    <button @click="updateTodo()" class="btn btn-primary">
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
