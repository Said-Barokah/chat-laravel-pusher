<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <nav class="relative z-50">
        <div class="container p-6 mx-auto">
            <div class="flex justify-center relative">
                <Link
                    class="block text-2xl font-bold text-center text-gray-800 dark:text-white lg:text-3xl hover:text-gray-700 dark:hover:text-gray-300"
                    href="#">Brand
                </Link>

                <div v-if="!$page.props.user" class="absolute right-[10px]">
                    <Link :href="route('login')" as="button"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mr-3">
                        Login
                    </Link>
                    <Link :href="route('register')"
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-full">
                    Register</Link>
                </div>
                <div v-if="$page.props.user" class="absolute right-[10px]">
                    <Link :href="route('dashboard')" as="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mr-3"> Dashboard </Link>
                </div>
            </div>
            <div class="flex items-center justify-center mt-6 text-gray-600 capitalize dark:text-gray-300">
                <Link href="#" class="text-gray-800 dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">home
                </Link>

                <Link href="#"
                    class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">
                features</Link>

                <Link href="#"
                    class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">
                pricing</Link>

                <Link href="#"
                    class="border-b-2 border-transparent hover:text-gray-800 dark:hover:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6">
                blog</Link>
            </div>
        </div>
    </nav>
</template>