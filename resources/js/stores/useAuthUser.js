import axios from "axios";
import {ref} from 'vue';
import { defineStore } from "pinia";


export const useAuthUser = defineStore('user',() =>  {
    // state: () => ({
    //     authUser: null,
    // }),
    // getters : {
    //     user: (state) => state.authUser,
    // },
    // actions: {
    //     async getUser() {
    //         const { data } = await axios.get('/auth-user');
    //         this.authUser = data;
    //     }
    // }

    const authUser = ref({});

    async function getUser() {
        const { data } = await axios.get('/auth-user');
        authUser.value = data;
    }

    function $reset() {
        authUser.value = null;
    }

    return {
        authUser,
        getUser,
        $reset,
    }

});