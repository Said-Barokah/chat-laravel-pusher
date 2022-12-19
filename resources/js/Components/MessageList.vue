<script setup>
import ChatForm from '@/Components/ChatForm.vue';
</script>
<template>
    <div class="w-full px-5 flex flex-col justify-between">
        <div class="flex flex-col mt-5">
            <div class="flex mb-4" v-for="message in messages"
                :class="message.model_sender_id == 1 ? 'flex-row-reverse justify-end' : 'justify-end'">
                <div>
                    <div :class="message.model_sender_id == 1 ? 'ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white' : 'mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-x'"
                        class="text-white">
                        {{ message.message }}
                    </div>
                </div>
                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600" class="object-cover h-8 w-8 rounded-full"
                    alt="" />
            </div>

        </div>

        <!-- Char form  -->
        <ChatForm v-on:messagesent="addMessage" :user="user" :idPsychologist="idPsychologist">
        </ChatForm>

    </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'

export default {
    props: ["user", "psychologists", 'idPsychologist'],
    data: function () {
        return {
            messages: []
        }

    },
    methods: {
        fetchMessages() {
            axios.get('/fetch/message/' + this.idPsychologist)
                .then(response => {
                    this.messages = response.data.messages;
                })
            // console.log(this.messages)

            // Inertia.get(route('fetch.messages', this.idPsychologist))
        },
        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message)
                .then(response => {
                    console.log(response.data);
                });
            // Inertia.post(route('send.message'), message);
        }
    },

    mounted() {
        this.fetchMessages()
        Echo.private("chat").listen("MessageSent", e => {
                this.messages.push(e.message)
            });

    }
}

</script>
