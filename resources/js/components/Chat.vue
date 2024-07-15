<script setup>
import {ref,} from 'vue';
import axios from 'axios';
import ThreeDotIcon from './ThreeDotIcon.vue';
import {useAuthUser} from './../stores/useAuthUser.js';
import  useLocalStorage  from './../composables/useLocalStorage.js'

const user = ref({});
const message  = ref('');
const authUser = JSON.parse(window.localStorage.getItem('authUser'));
const props = defineProps(['user']);
const btnDisable = ref(false);
user.value = props.user;

//Close Chat Handle
const emit = defineEmits(['isChatOpen']);
const closeChat = (e) =>{
    e.preventDefault();
    emit('isChatOpen', false);
}
//Websociket Listen
Echo.private('chat.' + authUser.id)
    .listen('MessageSend', (event) => {
        console.log(event.chat.message);
    });

//Send message Handle
const handleSend = (e) => {
    e.preventDefault();
    if (message.value !== '') {
        btnDisable.value = true;
        axios.post('/send-message', {
            'receiver_id' : user.value.id, 
            'message' : message.value,
            'authUser':  authUser.id,
        }).then((res) => {
            message.value = '';
            btnDisable.value = false;
        }).catch((error) => {
            btnDisable.value = false;
            console.log(error);
        })
    }
}





//Image Link
function fileLink() {
    return 'https://www.gravatar.com/avatar/2c7d99fe281ecd3bcd65ab915bac6dd5?s=50';
}
</script>
<template>
<!-- Chat Header-->
<div class="flex items-center justify-between mb-4 bg-slate-200 px-4 py-2 rounded-tl-md rounded-tr-md">
    <div class="flex">
        <img class="rounded-full w-12 h-12 border-2 border-white" :src="fileLink()">
        <div class="ml-3">
            <p class="font-semibold">{{ props.user.name }}</p>
            <p class="text-gray-500 text-xs">Hellow</p>
        </div>
    </div>
    <div class="relative inline-block text-left group">
        <ThreeDotIcon class="w-6 h-6 cursor-pointer"></ThreeDotIcon>
        <div class="origin-top-right absolute right-0 w-40 rounded-md shadow-lg bg-white top-ring-1 ring-black ring-opacity-5 z-50 hidden group-hover:block">
            <div class="py-1">
                <a href="" @click="closeChat" class="block py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer px-4">Close Chat</a>
                <a href="" class="block py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer px-4">Clear Chat</a>
            </div>
        </div>
    </div>
    </div>
    <!-- Chat Body-->
    <div class="overflow-y-auto max-h-64 min-h-[19rem] px-4 flex flex-col-reverse">
    <div class="flex items-center space-x-1 mb-2">
        <img class="rounded-full w-6 h-6 border-2 border-white" :src="fileLink()">
        <div class="relative group text-sm p-2 shadow bg-white rounded-md max-w-xs">
            Lorem, ipsum dolor sit amet consectetur 
            <div class="absolute top-1/2 -translate-y-1/2 left-full ml-1 rounded bg-gray-600 py-1 px-1.5 z-50 text-white hidden group-hover:block w-max">12:00</div>
        </div>
        <ThreeDotIcon class="w-4 h-4 cursor-pointer"></ThreeDotIcon>
    </div>
    <div class="flex items-center justify-end space-x-1 mb-2">
        <ThreeDotIcon class="w-4 h-4 cursor-pointer"></ThreeDotIcon>
        <div class="relative group text-sm p-2 shadow bg-indigo-100 rounded-md max-w-xs">
            Lorem, ipsum dolor sit amet consectetur 
            <div class="absolute top-1/2 -translate-y-1/2 right-full mr-1 rounded bg-gray-600 py-1 px-1.5 z-50 text-white hidden group-hover:block w-max">Lorem ipsum dolor sit amet consectetur</div>
        </div>
        <img class="rounded-full w-6 h-6 border-2 border-white" :src="fileLink()">
    </div>
    </div>
    <!-- Chat Footer-->
    <div class="flex items-center bg-white rounded-bl-md rounded-br-md p-4">
        <input type="text" v-model="message" placeholder="Type you message here..." class="w-full p-2 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-400">
        <button @click="handleSend" :disabled="btnDisable" class="bg-blue-600 text-white px-4 py-2 rounded-md disabled:bg-gray-700 ml-2">Send</button>
    </div>
</template>