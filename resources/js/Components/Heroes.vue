<script setup>

import Navbar from '@/Components/Navbar.vue'

</script>
<template>
    <header class="bg-white dark:bg-gray-800 min-h-screen relative">
        <Navbar />
        <div class="container flex flex-col px-6 py-4 mx-auto space-y-6 md:h-128 md:py-16 md:flex-row md:items-center md:space-x-6">
            <div class="flex flex-col items-center w-full md:flex-row md:w-1/2">
                <div class="flex justify-center order-2 mt-6 md:mt-0 md:space-y-3 md:flex-col">
                    <button class="w-3 h-3 mx-2 bg-blue-500 rounded-full md:mx-0 focus:outline-none"></button>
                    <button
                        class="w-3 h-3 mx-2 bg-gray-300 rounded-full md:mx-0 focus:outline-none hover:bg-blue-500"></button>
                    <button
                        class="w-3 h-3 mx-2 bg-gray-300 rounded-full md:mx-0 focus:outline-none hover:bg-blue-500"></button>
                    <button
                        class="w-3 h-3 mx-2 bg-gray-300 rounded-full md:mx-0 focus:outline-none hover:bg-blue-500"></button>
                </div>

                <div class="max-w-lg md:mx-12 md:order-2">
                    <h1
                        class="font-montserrat font-extrabold leading-[90px] text-3xl font-700 tracking-wide text-gray-800 dark:text-white md:text-[70px]">
                        The Most Valuable Thing is Your Health
                    </h1>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">Konsultasi online dengan psikolog professional yang
                        ahli di bidangnya masing-masing. Kami siap meleyani anda dengan sepenuh hati</p>
                    <div class="mt-6">
                        <a href="#"
                            class="block px-3 py-2 font-semibold text-center text-white transition-colors duration-200 transform bg-blue-500 rounded-md md:inline hover:bg-blue-400">
                            Konsultasi sekarang</a>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 right-0">
                <img class="object-cover h-[650px] rounded-md" src="/heroes-bg.webp" alt="apple watch photo">
            </div>
        </div>
    </header>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200;800&display=swap" rel="stylesheet');

.font-montserrat {
    font-family: 'Montserrat', sans-serif;
}
</style>