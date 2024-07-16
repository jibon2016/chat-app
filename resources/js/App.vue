<script setup>
import {onMounted, ref, watch} from 'vue';
import ThreeDotIcon from './components/ThreeDotIcon.vue';
import Chat from './components/Chat.vue';
import axios from 'axios';
import {useAuthUser} from './stores/useAuthUser.js';
import  useLocalStorage  from './composables/useLocalStorage.js'

const isChatOpen = useLocalStorage(false, 'isChatOpen');
const users = [];
const chatUser = useLocalStorage({}, 'chatUser');
const authUser = useLocalStorage({}, 'authUser');
const filterUsers = ref({});
const search = ref("");
const authStore = useAuthUser();

//Handle Logout Function
const logout = (e) =>{
    e.preventDefault();
    console.log('ok');
};

//Search Filter 
const filterUser = () => {
    if(search.value !== ''){
        return filterUsers.value =  users[0].filter(user => user.name.includes(search.value))
    }
    return filterUsers.value = users[0];
}
    
//Image Linking 
function fileLink() {
return 'https://www.gravatar.com/avatar/2c7d99fe281ecd3bcd65ab915bac6dd5?s=50';
}

//Click User Tab
const handleUser = (user) => {
    isChatOpen.value = true;
    chatUser.value = user;
}

//Close Chat Event Handle
const handleEmit = (e) => {
    isChatOpen.value = e;
    useAuthUser().$reset();
}

//Get All user and Get Auth User
onMounted( async () => {
    await axios.get('/all-user').then((res) => {
        users.push(res.data);
        filterUsers.value = users[0];
    })

    await authStore.getUser();
    authUser.value = authStore.authUser;
    //WebSockit Listen
    Echo.private('chat.'+ authUser.value.id)
        .listen('MessageSend', (event) => {
            // console.log(event.chat.message);
        });
});

</script>

<template>
<!-- Header Section -->
<div class="bg-white border-b border-gray-300 fixed top-0 w-full shadow">
    <div class="lg:container mx-auto p-4">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-1 min-w[250px]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-between">
                        <img class="rounded-full w-12 h-12 border-2 border-blue-400" :src="fileLink()">
                        <span class="font-semibold text-xl pl-1">{{ authUser.name }}</span>
                    </div>
                    <div class="relative inline-block text-left group">
                        <ThreeDotIcon class="w-6 h-6 cursor-pointer"></ThreeDotIcon>
                        <div class="origin-top-right absolute right-0 w-40 rounded-md shadow-lg bg-white top-ring-1 ring-black ring-opacity-5 z-50 hidden group-hover:block">
                            <div class="py-1">
                                <a href="" class="block py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer px-4">Profile</a>
                                <a href="" class="block py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer px-4">Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 text-right">
                <button class="bg-red-700 text-white px-4 py-2 rounded-md" @click="logout">Logout</button>
            </div>
        </div>
    </div>
</div>  
<!-- Header Section End -->
<!-- Body Section Start -->
<div class="mt-[90px] lg:container mx-auto px-4 mb-4 ">
    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-1 min-w[300px] bg-white p-4 shadow-md rounded-md">
            <!-- Chat Search-->
            <div>
                <input type="text" placeholder="Search" @keyup="filterUser" v-model="search" class="w-full p-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-400 mb-4">
            </div>
            <!--Chat List-->
            <div class="max-h-96 overflow-y-auto" >
                <div v-for="user in filterUsers" :key="user.id" @click="handleUser(user)" class="flex p-2 items-center mb-3 mr-2 cursor-pointer bg-gray-100 hover:border hover:border-blue-200 rounded-md">
                    <div class="relative shrink">
                        <img class="rounded-full w-8 h-8 md:w-12 md:h-12" :src="fileLink()">
                        <div class="absolute w-3 h-3 bg-slate-400 rounded-full top-0"></div>
                    </div>
                    <div class="ml-3 grow">
                        <p class="font-semibold text-sm md:text-md">{{ user.name }}</p>
                        <p class="text-gray-500 text-xs">Hello</p>
                    </div>
                </div>
                <!-- <div class="flex p-2 items-center mb-3 cursor-pointer hover:bg-gray-100 rounded-md">
                    <div class="relative">
                        <img class="rounded-full w-12 h-12" :src="fileLink()">
                        <div class="absolute w-3 h-3 bg-green-400 rounded-full top-0"></div>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">Sobuj</p>
                        <p class="text-gray-500 text-xs">Hellow</p>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="col-span-2 bg-slate-50 shadow rounded-md">
            <div v-if="isChatOpen" class="">
                <Chat  v-if="chatUser"  @isChatOpen="handleEmit" :user="chatUser"></Chat>
            </div>
            <div v-else class="flex flex-col items-center justify-center min-h-[19rem]">
                <img class="rounded-full w-20 h-20" :src="fileLink()">
                <p class="text-2xl font-semibold mt-4">Jibon IT</p>
                <p class="text-gray-500">Select a chat to start messiging</p>
            </div>
        </div>
    </div>
</div>
<!-- Body Section End -->
</template>