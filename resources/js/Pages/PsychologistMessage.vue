<script setup>
import PsychologistAppLayout from '@/Layouts/PsychologistAppLayout.vue';
import ChatUserList from '@/Components/ChatUserList.vue';
import MessageList from '@/Components/MessageList.vue'
</script>

<template>
    <PsychologistAppLayout >
        <div class="">
            <div class=" mx-auto ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Compenent Chat -->
                    <div class="container mx-auto shadow-lg rounded-lg">
                        <!-- headaer -->
                        <!-- end header -->
                        <!-- Chatting -->
                        <div class="flex flex-row justify-between bg-white">
                            <!-- chat list -->
                            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                                <!-- search compt -->
                                <div class="border-b-2 py-4 px-2">
                                    <input type="text" placeholder="search chatting"
                                        class="py-2 px-2 border-2 border-gray-200 rounded-2xl w-full" />
                                </div>
                                <!-- end search compt -->
                                <!-- chat user list -->

                                <ChatUserList></ChatUserList>
                                <!-- end user list -->
                            </div>
                            <!-- end chat list -->
                            <!-- message -->
                            <!-- end message -->
                            <MessageList>
                            </MessageList>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PsychologistAppLayout>
</template>
