<template>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-lg-4 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <div class="text-center mt-3 mb-4" v-show="msgError">
                            <div class="alert alert-danger">{{ msgError }}</div>
                        </div>

                        <form method="post" @submit.prevent="handleSubmit">
                            <div class="mb-4">
                                <label for="">Username</label>
                                <input type="text" class="form-control" placeholder="Enter Username" v-model="username">
                            </div>
                            <div class="mb-4">
                                <label for="">Password</label>
                                <input type="password" class="form-control" placeholder="Enter Password" v-model="password">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from '../axios';
import { useAuthStore } from '../stores/auth';
import { useRouter } from 'vue-router';

let username = ref('')
let password = ref('')
let msgError = ref(null)

const router = useRouter();
const authStore = useAuthStore();

const handleSubmit = async () => {
    msgError.value = null;
    try {
        const res = await axios.post("/login", {
            username: username.value,
            password: password.value
        });

        const data = await res.data;

        // set token to pinia store 
        authStore.setToken(data.token);

        // set token ke local storage
        localStorage.setItem('access_token', JSON.stringify(data.token));
        await router.push('/');
    } catch (err) {
        if(err.response) {
            if(err.response.status === 401) {
                msgError.value = err.response.data.message;
            }
        } else {
            msgError.value = 'Whoops, something went wrong.';
        }
    }
}
</script>