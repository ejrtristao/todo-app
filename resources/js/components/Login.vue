<script setup>
import {reactive, ref, inject} from 'vue';
import {useRouter} from 'vue-router';

let router = useRouter();

  let cookies = inject('cookies');

  let isAuthenticated = ref(false);

  const form = reactive({
    email: '',
    password: '',
  });

  const login = async () => {
    let res = await axios.post('/api/login', form);
    if(res.data.status === 'success') {
      cookies.set('token', res.data.token);
      isAuthenticated.value = true;
      router.push('/');
    }
  }

  

</script>

<template>
  <div class="row">
    <div class="col-lg-7 m-auto">
      <card>
        <!-- <form @submit.prevent="login"> -->
          <!-- Email -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">E-mail</label>
            <div class="col-md-7">
                <input type="email" v-model="form.email" />

            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end">Password</label>
            <div class="col-md-7">
                <input type="password" v-model="form.password" />
            </div>
          </div>

          <!-- Remember Me -->

          <div class="mb-3 row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Login</button>
                <button @click="login" class="btn btn-primary">Texte</button>
            </div>
          </div>
        <!-- </form> -->
      </card>
    </div>
  </div>
</template>

