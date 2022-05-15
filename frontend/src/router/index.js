import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import ('../views/Dashboard.vue')
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import ('../views/Login.vue')
    }
  ]
});

router.beforeEach( async (to, from) => {
  const token = await localStorage.getItem('access_token');
  if(to.path !== '/login') {
    if(token) {
      return true;
    } else {
      console.log('redirect to login')
      return '/login';
    }
  /** jika sudah login dan mempunyai token kembalikan ke home page  */
  } else if (to.path === '/login' && token) {
    return '/';
  }
})

export default router
