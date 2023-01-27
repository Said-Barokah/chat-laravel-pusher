<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ChatUserList from '@/Components/ChatUserList.vue';
import MessageList from '@/Components/MessageList.vue'
</script>

<template>
    <AppLayout title="Chat">
        <div class="fixed w-screen h-screen top-0 left-0">
            <div class="h-full ">
                <div class="overflow-hidden shadow-xl sm:rounded-lg h-full">
                    <!-- Compenent Chat -->
                    <div class="container w-full shadow-lg rounded-lg pt-[70px] h-full">
                        <!-- headaer -->
                        <!-- end header -->
                        <!-- Chatting -->
                        <div class="flex flex-row justify-between bg-white w-screen h-full">
                            <!-- chat list -->

                            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                                <!-- search compt -->
                                <!-- end search compt -->
                                <!-- chat user list -->

                                <ChatUserList></ChatUserList>
                                <!-- end user list -->
                            </div>
                           
                            <!-- end chat list -->
                            <!-- message -->
                            <!-- end message -->
                            <MessageList >
                            </MessageList>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

