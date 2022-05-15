<template>
    Logged in

    <p class="mt-5 mb-5">
        <button class="btn btn-primary" type="button" @click="getProfile">Get Profile</button>
    </p>

    <p>
        <button type="button" class="btn btn-danger" @click="logout">Logout</button>
    </p>
</template>

<script setup>
import { useRouter } from 'vue-router';
import defaultApi from '../axios';
import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();
const router = useRouter();

// console.log('token dashboard', authStore.token)

const logout = async () => {
    // hapus token dari local storage
    localStorage.removeItem('access_token');
    await router.push('/login');
}

const getProfile = async () => {
    try {
        const response = await defaultApi.post('/profile', null, 
        {
            headers: {
                'Authorization': 'Bearer ' + authStore.token
            }
        }
        );
        const data = await response.data;
        console.log(data);
    } catch (err) {
        console.log(err.response)
    }
}
</script>