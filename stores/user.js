import { defineStore } from "pinia";

export const userStore = defineStore('user', {
    state: () => ({
        token: "",
        name: "",
        email: ""
    }),
    getters: {
        get(state) {
            return state
        }
    },
    actions: {
        set(data) {
            this.token = data.token
            this.name = data.name
            this.email = data.email
        }
    },
    persist: true
})