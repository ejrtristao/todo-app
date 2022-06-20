<script setup>
import {ref, onMounted,inject} from 'vue';
import {useRouter} from 'vue-router';

let form = ref({
    todo: '',
    description: '',
    user: '',
})

let cookies = inject("cookies");

const router = useRouter();

const createTodo = () => {
    const formData = new FormData();
    formData.append('todo', form.value.todo);
    formData.append('description', form.value.description);
    formData.append('user_id', form.value.user);

    axios.post('/api/todos', formData)
        .then((response) => {
            router.push('/');
        })
        .catch((error) => {
            console.log(error);
        });
}


</script>

<template>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-12">
                <h1>Nova Tarefa</h1>
            </div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="todo">Tarefa</label>
                        <input
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
                    <button @click="createTodo()" class="btn btn-primary">
                        Salvar
                    </button>
            </div>
        </div>
    </div>
</template>
