
<template>
    <Link v-show="$page.props.psychologists" :href="route('index.messages',psychologist.id)"  class="flex flex-row py-4 px-2 items-center border-b-2 justify-center" v-for="psychologist in $page.props.psychologists">
        <div class="w-1/4">
            <img src="https://source.unsplash.com/_7LbC5J-jw4/600x600" class="object-cover h-12 w-12 rounded-full"
                alt="" />
        </div>
        <div class="w-full">
            <div class="text-lg font-semibold"> {{ psychologist.name }} </div>
            <span class="text-gray-500">Pick me at 9:00 Am</span>
        </div>
        <span v-show="notification !=0" class="bg-blue-600 text-white rounded-full w-9 text-center"> {{ notification }} </span>
    </Link>
    <Link v-show="$page.props.clients" :href="route('psychologist.index.messages',client.id)"  class="flex flex-row py-4 px-2 items-center border-b-2 justify-center" v-for="client in $page.props.clients">
        <div class="w-1/4">
            <img src="https://source.unsplash.com/_7LbC5J-jw4/600x600" class="object-cover h-12 w-12 rounded-full"
                alt="" />
        </div>
        <div class="w-full">
            <div class="text-lg font-semibold"> {{ client.name }} </div>
            <span class="text-gray-500">Pick me at 9:00 Am</span>
        </div>
        <span v-show="notification !=0" class="bg-blue-600 text-white rounded-full w-9 text-center"> {{ notification }} </span>
    </Link>

</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default{
    components : {
        Head,
        Link
    },

    data(){
        return {
            notification : 0
        }
    },
    mounted(){
        Echo.channel("chat").listen("MessageSent", e => {
            this.notification += 1
        });
    }
}
</script>
