<template>
    <div v-show="$page.props.idPsychologist" class="py-5">
        <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here..."
        v-model="newMessage" @keyup.enter="sendMessage" />
    </div>

    <div v-show="$page.props.idClient" class="py-5">
        <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here..."
        v-model="newMessage" @keyup.enter="sendMessageClient" />
    </div>

    <div v-show="$page.props.canChat" class="py-5">
        <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here..."
        v-model="newMessage" @keyup.enter="sendMessage" />
    </div>
</template>
<script>
export default {
    data() {
        return {
            newMessage: "",
        };
    },
    methods: {
        sendMessage() {
            this.$emit("messagesent", {
                orderId : this.$page.props.order[0].order_id,
                model_sender_id : 2,
                message: this.newMessage,
            });
            //Clear the input
            this.newMessage = "";
        },

        // untuk autentifikasi psikolog
        sendMessageClient() {
            this.$emit("messagesent", {
                userId: this.$page.props.user.id,
                idClient : this.$page.props.idClient,
                message: this.newMessage,
            });
            this.newMessage = "";
        }
    }
}
</script>
