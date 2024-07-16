<script setup>
import {ref, onMounted, watch, reactive, computed} from 'vue';
import axios from 'axios';
import ThreeDotIcon from './ThreeDotIcon.vue';

const user = ref({});
const chats  = reactive({});
const typing  = ref('');
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

/* 
    Join in a one single Channel
    Echo.join('chat.1')
    .here((users) =>{
        console.log(users);
    })
*/

/*
    Typing User
*/
    const channel = Echo.private('app')


    channel.listenForWhisper('typing', (event) => {
        if(event.id == user.value.id){
            typing.value = "Typing..."
        }
    });
    channel.listenForWhisper('typingEnd', (event) => {
        if(event.id == user.value.id){
            typing.value = '';
        }
    });

    const handleFocus = (e) => {
        channel.whisper('typing', {
            'id': authUser.id,
        })
    };
    const handleFocusOut = (e) => {
        channel.whisper('typingEnd', {
            'id': authUser.id,
        })
    };

    Echo.private('chat.' + user.value.id)
    .listen('MessageSend', (event) => {
        chats.value.unshift(event.chat);
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
            chats.value.unshift(res.data);
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


watch( () => props.user, async (newUser) => {
    chats.value = [];
    user.value = newUser;
    await axios.get('/chat/' + authUser.id + '/' + user.value.id ).then((res) => {
        chats.value = res.data;
    })
    console.log(chats);
}, {deep:true})


onMounted(async () => {
    await axios.get('/chat/' + authUser.id + '/' + user.value.id ).then((res) => {
        chats.value = res.data;
    })
})


const getTime = (time) => {
    const date = new Date(time)
    return date.toLocaleTimeString([], { year: "numeric",  month: "long",  day: "numeric", hour: 'numeric', minute: 'numeric', hour12: true });
}

</script>
<template>
<!-- Chat Header-->
<div class="flex items-center justify-between mb-4 bg-slate-200 px-4 py-2 rounded-tl-md rounded-tr-md">
    <div class="flex">
        <img class="rounded-full w-12 h-12 border-2 border-white" :src="fileLink()">
        <div class="ml-3">
            <p class="font-semibold">{{ props.user.name }}</p>
            <p class="text-gray-500 text-xs">Friend</p>
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
        <div v-if="chats" v-for="chat in chats.value">
            <div v-if="authUser.id == chat.sender_id" class="flex items-center justify-end space-x-1 mb-2">
                <ThreeDotIcon class="w-4 h-4 cursor-pointer"></ThreeDotIcon>
                <div class="relative group text-sm p-2 shadow bg-indigo-100 rounded-md max-w-xs">
                    {{ chat.message }}
                    <div class="absolute top-1/2 -translate-y-1/2 right-full mr-1 rounded bg-gray-600 py-1 px-1.5 z-50 text-white hidden group-hover:block w-max">{{  getTime(chat.created_at) }}</div>
                </div>
                <img class="rounded-full w-6 h-6 border-2 border-white" :src="fileLink()">
            </div>
            <div v-else class="flex items-center space-x-1 mb-2">
                <img class="rounded-full w-6 h-6 border-2 border-white" :src="fileLink()">
                <div class="relative group text-sm p-2 shadow bg-white rounded-md max-w-xs">
                    {{ chat.message }}
                    <div class="absolute top-1/2 -translate-y-1/2 left-full ml-1 rounded bg-gray-600 py-1 px-1.5 z-50 text-white hidden group-hover:block w-max">{{ getTime(chat.created_at) }}</div>
                </div>
                <ThreeDotIcon class="w-4 h-4 cursor-pointer"></ThreeDotIcon>
            </div>
        </div>
        <div v-else class="overflow-y-auto max-h-64 min-h-[19rem] px-4 flex flex-col-reverse">
            <div class="text-center bg-blue-200 mx-auto px-2 py-1 rounded-lg text-xs">Send a Message</div>
        </div>
    </div>
    
    <!-- Chat Footer-->
    <div class="flex items-center bg-white rounded-bl-md rounded-br-md p-4">
        <div class="w-full relative">
            <input type="text" @focus="handleFocus" @focusout="handleFocusOut" v-model="message" @keyup.enter="handleSend" placeholder="Type you message here..." class="w-full p-2 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-400">
            
            <div v-if="typing" class="absolute">
                <span class=" animate-pulse text-[12px] ml-2 text-green-500 ">Typing...</span>
            </div>
        </div>
        <button @click="handleSend" :disabled="btnDisable" class="bg-blue-600 text-white px-4 py-2 rounded-md disabled:bg-gray-700 ml-2">Send</button>
        
    </div>
    
</template>