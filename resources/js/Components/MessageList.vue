<script setup>
import ChatForm from '@/Components/ChatForm.vue';
</script>
<template>
    <div v-show="$page.props.psychologists" class="w-full px-5 flex flex-col justify-between">
        <div class="flex flex-col mt-5">
            <div class="flex mb-4" v-for="message in messages"
                :class="message.model_sender_id == 1 ? 'flex-row-reverse justify-end' : 'justify-end'">
                <div>
                    <div :class="message.model_sender_id == 1 ? 'ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white' : 'mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl'"
                        class="text-white">
                        {{ message.message }}
                    </div>
                </div>
                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600" class="object-cover h-8 w-8 rounded-full"
                    alt="" />
            </div>
        </div>

        <ChatForm v-on:messagesent="addMessage">
        </ChatForm>

    </div>

    <div v-show="$page.props.clients" class="w-full px-5 flex flex-col justify-between">
        <div class="flex flex-col mt-5">
            <div class="flex mb-4" v-for="message in messages"
                :class="message.model_sender_id == 2 ? 'flex-row-reverse justify-end' : 'justify-end'">
                <div>
                    <div :class="message.model_sender_id == 2 ? 'ml-2 py-3 px-4 bg-gray-400 rounded-tl-3xl rounded-bl-3xl rounded-tr-xl text-white' : 'mr-2 py-3 px-4 bg-blue-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl'"
                        class="text-white">
                        {{ message.message }}
                    </div>
                </div>
                <img src="https://source.unsplash.com/vpOeXr5wmR4/600x600" class="object-cover h-8 w-8 rounded-full"
                    alt="" />
            </div>
        </div>
        <ChatForm v-on:messagesent="addMessageClient">
        </ChatForm>

    </div>
</template>
<script>

export default {
    data: function () {
        return {
            messages: []
        }

    },
    methods: {
        fetchMessages(idPsychologist) {
            axios.get('/fetch/message/' + idPsychologist)
                .then(response => {
                    this.messages = response.data.messages;
                })
            // console.log(this.messages)
            // Inertia.get(route('fetch.messages', this.idPsychologist))
        },
        fetchMessagesClient(idClient) {
            axios.get('/fetch-psychologist/message/' + idClient)
                .then(response => {
                    this.messages = response.data.messages;
                })
        },
        addMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message)
                .then(response => {
                    console.log(response.data);
                });
        },

        addMessageClient(message) {
            this.messages.push(message);
            axios.post('/messages-psychologist', message)
                .then(response => {
                    console.log(response.data);
                });
        }
    },

    mounted() {
        if (this.$page.props.idPsychologist) {
            this.fetchMessages(this.$page.props.idPsychologist)
        }
        else if (this.$page.props.idClient) {
            this.fetchMessagesClient(this.$page.props.idClient)
        }
        Echo.channel("chat").listen("MessageSent", e => {
            this.messages.push(e.message)
        });
    }
}

</script>
