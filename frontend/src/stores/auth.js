import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    token: null
  }),
  // getters: {
  //   doubleCount: (state) => state.counter * 2
  // },
  actions: {
    setToken(token) {
      this.token = token;
    }
  }
})
