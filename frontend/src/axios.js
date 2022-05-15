import axios from 'axios';
import router from './router/index';
import { useAuthStore } from './stores/auth';

const authStore = useAuthStore();
const baseUrl = 'http://localhost:4000';
const token = authStore.token ? authStore.token : localStorage.getItem('access_token');
console.log('token axios', token);

let defaultApi = axios.create({
    baseURL: baseUrl,
    headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json' 
    }
});


defaultApi.interceptors.response.use((response) => response, (error) => {
    if(error.response.status === 401) {
        localStorage.removeItem("access_token");
        router.push({
            name: 'Login'
        });
    }
    if(error.response.status >= 500) {
       alert('Whoops, something went wrong');
    }
    return Promise.reject(error);
});

export default defaultApi;