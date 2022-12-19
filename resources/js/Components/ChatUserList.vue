
<template>
    <Link :href="route('index.messages',psychologist.id)"  class="flex flex-row py-4 px-2 items-center border-b-2 justify-center" v-for="psychologist in psychologists">
        <div class="w-1/4">
            <img src="https://source.unsplash.com/_7LbC5J-jw4/600x600" class="object-cover h-12 w-12 rounded-full"
                alt="" />
        </div>
        <div class="w-full">
            <div class="text-lg font-semibold">Luis1994</div>
            <span class="text-gray-500">Pick me at 9:00 Am</span>
        </div>
    </Link>

    <div class="flex flex-row py-4 px-2 items-center border-b-2 border-l-4 border-blue-400">
        <div class="w-1/4">
            <img src="https://source.unsplash.com/L2cxSuKWbpo/600x600" class="object-cover h-12 w-12 rounded-full"
                alt="" />
        </div>
        <div class="w-full">
            <div class="text-lg font-semibold">MERN Stack</div>
            <span class="text-gray-500">Lusi : Thanks Everyone</span>
        </div>
    </div>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default{
    components : {
        Head,
        Link
    },
    props:["user","psychologists"]
}
</script>
