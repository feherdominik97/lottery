import { defineStore } from 'pinia'

const API_BASE = "http://localhost:8000/api"

interface UserPayloadInterface {
    email: string
    password: string
}

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authenticated: false,
        name: ""
    }),
    getters: {
      getName(state) {
          return state.name
      }
    },
    actions: {
        async authenticateUser({ email, password }: UserPayloadInterface) {
            const { data }: any = await useFetch(`${API_BASE}/login`, {
                method: 'post',
                headers: { 'Content-Type': 'application/json' },
                body: {
                    email,
                    password,
                },
            })

            if (data.value.success) {
                const token = useCookie('token')
                token.value = `Bearer ${data?.value?.data?.token}`
                this.authenticated = true
                this.name = data?.value?.data?.name
            }
        },
        logUserOut() {
            const token = useCookie('token')
            this.authenticated = false
            token.value = null
        },
    },
    persist: true
});