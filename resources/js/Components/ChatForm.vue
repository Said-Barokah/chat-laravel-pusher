<template>
    <div class="py-5">
        <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" placeholder="type your message here..."
        v-model="newMessage" @keyup.enter="sendMessage" />
    </div>
</template>
<script>
export default {
    props: ["user","idPsychologist"],
    data() {
        return {
            newMessage: "",
        };
    },
    methods: {
        sendMessage() {
            this.$emit("messagesent", {
                userId: this.user.id,
                idPsychologist : this.idPsychologist,
                //newMessage is bound to the earlier "btn-input" input field
                message: this.newMessage,
            });
            //Clear the input
            this.newMessage = "";
        }
    }
}
</script>
