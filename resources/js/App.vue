    <script setup>
    import ThreeDotIcon from './components/ThreeDotIcon.vue'

    const isChatOpen = true;
    const logout = (e) =>{
    e.preventDefault();
    console.log('ok');
    };

    function fileLink(file) {
    return 'https://www.gravatar.com/avatar/2c7d99fe281ecd3bcd65ab915bac6dd5?s=50';
    }

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
                            <span class="font-semibold text-xl pl-1">Jibon Sutradhar</span>
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
                    <input type="text" placeholder="Seacrch" class="w-full p-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-400 mb-4">
                </div>
                <!--Chat List-->
                <div class="max-h-96 overflow-y-auto">
                    <div class="flex p-2 items-center mb-3 cursor-pointer bg-gray-100 rounded-md">
                        <div class="relative">
                            <img class="rounded-full w-12 h-12" :src="fileLink()">
                            <div class="absolute w-3 h-3 bg-slate-400 rounded-full top-0"></div>
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold">Sobuj</p>
                            <p class="text-gray-500 text-xs">Hellow</p>
                        </div>
                    </div>
                    <div class="flex p-2 items-center mb-3 cursor-pointer hover:bg-gray-100 rounded-md">
                        <div class="relative">
                            <img class="rounded-full w-12 h-12" :src="fileLink()">
                            <div class="absolute w-3 h-3 bg-green-400 rounded-full top-0"></div>
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold">Sobuj</p>
                            <p class="text-gray-500 text-xs">Hellow</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2 bg-slate-50 shadow rounded-md">
                <div v-if="isChatOpen" class="">
                    <!-- Chat Header-->
                    <div class="flex items-center justify-between mb-4 bg-slate-200 px-4 py-2 rounded-tl-md rounded-tr-md">
                        <div class="flex">
                            <img class="rounded-full w-12 h-12 border-2 border-white" :src="fileLink()">
                            <div class="ml-3">
                                <p class="font-semibold">Sobuj</p>
                                <p class="text-gray-500 text-xs">Hellow</p>
                            </div>
                        </div>
                        <div class="relative inline-block text-left group">
                            <ThreeDotIcon class="w-6 h-6 cursor-pointer"></ThreeDotIcon>
                            <div class="origin-top-right absolute right-0 w-40 rounded-md shadow-lg bg-white top-ring-1 ring-black ring-opacity-5 z-50 hidden group-hover:block">
                                <div class="py-1">
                                    <a href="" class="block py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer px-4">Close Chat</a>
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
                        <input type="text" placeholder="Seacrch" class="w-full p-2 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:border-blue-400">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md disabled:bg-gray-700 ml-2">Send</button>
                    </div>
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