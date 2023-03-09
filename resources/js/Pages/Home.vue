<script setup>

import Heroes from '@/Components/Heroes.vue';
import PschicologistCards from '@/Components/PschicologistCards.vue';
import CorouselClient from '@/Components/CorouselClient.vue'
</script>

<template>
    <Heroes />
    <div class="flex py-[100px] px-[100px] justify-center">
        <div class="w-[50%]">
            <img class="object-contain" src="ps-group.webp" alt="">
        </div>
        <div class="ml-[40px] w-[50%]">
            <h1
                class="font-montserrat leading-[40px] font-extrabold text-3xl font-700 tracking-wide text-gray-800 md:text-[40px]">
                Welcome to</h1>
            <h1
                class="font-montserrat leading-[40px] font-extralight text-3xl font-700 tracking-wide text-gray-800 md:text-[40px]">
                Persetemanan Sejiwa</h1>
            <p class="pt-[20px]">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempore facilis officiis
                quidem magnam
                delectus. Officia mollitia delectus quasi suscipit commodi dolores labore aspernatur nisi quis,
                cupiditate iure inventore natus beatae.</p>

            <ul class="py-[20px]">
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="inline-block">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M11.602 13.76l1.412 1.412 8.466-8.466 1.414 1.414-9.88 9.88-6.364-6.364 1.414-1.414 2.125 2.125 1.413 1.412zm.002-2.828l4.952-4.953 1.41 1.41-4.952 4.953-1.41-1.41zm-2.827 5.655L7.364 18 1 11.636l1.414-1.414 1.413 1.413-.001.001 4.951 4.951z"
                            fill="rgba(47,204,113,1)" />
                    </svg>
                    <span>Bekerja sama dengan Psikologi Profesional</span>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="inline-block">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M11.602 13.76l1.412 1.412 8.466-8.466 1.414 1.414-9.88 9.88-6.364-6.364 1.414-1.414 2.125 2.125 1.413 1.412zm.002-2.828l4.952-4.953 1.41 1.41-4.952 4.953-1.41-1.41zm-2.827 5.655L7.364 18 1 11.636l1.414-1.414 1.413 1.413-.001.001 4.951 4.951z"
                            fill="rgba(47,204,113,1)" />
                    </svg>
                    <span>Harga konsultasi terjangkau</span>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="inline-block">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M11.602 13.76l1.412 1.412 8.466-8.466 1.414 1.414-9.88 9.88-6.364-6.364 1.414-1.414 2.125 2.125 1.413 1.412zm.002-2.828l4.952-4.953 1.41 1.41-4.952 4.953-1.41-1.41zm-2.827 5.655L7.364 18 1 11.636l1.414-1.414 1.413 1.413-.001.001 4.951 4.951z"
                            fill="rgba(47,204,113,1)" />
                    </svg>
                    <span>Mempunyai layanan yang berkualitas</span>
                </li>
            </ul>

            <button
                class="block px-3 py-2 font-semibold text-center text-white transition-colors duration-200 transform bg-blue-500 rounded-md md:inline hover:bg-blue-400">Contack
                Us</button>
        </div>
        <!-- ba - image -->
    </div>

    <div class="py-[100px]">
        <div class="flex justify-between px-[100px] mb-[50px]">
            <div>
                <h1
                    class="font-montserrat leading-[45px] font-extrabold text-3xl font-700 tracking-wide text-gray-800 md:text-[40px]">
                    Happy Mind <span class="block">Healthy Life</span> </h1>
                <h2
                    class="mt-[20px] font-montserrat leading-7 font-extralight text-3xl font-700 tracking-wide text-gray-800 md:text-[29px]">
                    Almost before we knew it,<span class="block">we had left the ground</span> </h2>
            </div>


            <button class="group relative h-12 w-48 overflow-hidden rounded-lg bg-[#1f2937] text-lg shadow">
                <div
                    class="absolute inset-0 w-0 bg-blue-300 transition-all duration-[250ms] animate-pulse group-hover:w-full">
                </div>
                <span class="relative text-white group-hover:text-white">Take a Service</span>
            </button>
        </div>
        <PschicologistCards />
        <CorouselClient />
    </div>
</template>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200;800&display=swap" rel="stylesheet');

.font-montserrat {
    font-family: 'Montserrat', sans-serif;
}

</style>
<script>
export default {
    mounted(){
        var src = document.createElement('script');
        src.setAttribute('src','https://app.sandbox.midtrans.com/snap/snap.js');
        src.setAttribute('data-client-key','SB-Mid-client-uoRisER8_nBeuQxa')
        document.head.appendChild(src);
        }
}
</script>
