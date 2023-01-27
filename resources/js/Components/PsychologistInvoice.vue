<script setup>

import { Link } from '@inertiajs/inertia-vue3';
import Polkadot from '@/Components/Polkadot.vue';

</script>
<template>
    <div class="relative my-3 h-screen flex justify-center items-center antialiased text-gray-900">
        <div class="w-full px-4 md:w-1/2 lg:w-1/3 animate-fade-in-down">
            <div class="w-fit border-primary shadow-pricing relative z-10 mb-10 overflow-hidden rounded-xl border border-opacity-20 bg-white py-10 px-8 sm:p-12 lg:py-10 lg:px-6 xl:p-12">
                <span class="cursor-pointer text-gray-500 top-5 left-8 text-[20px] absolute"
                    @click="$emit('invoiceOff')">
                    <svg class="animate-bounce" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                            fill="rgba(122,122,122,1)" />
                    </svg>
                </span>

                <div class="relative mx-auto text-primary mb-4 block text-lg bg-gray-300 w-fit px-3 rounded-lg py-2 border border-gray-400">
                    <span class="absolute flex h-5 w-5 top-[-8px] right-[-8px]">
                        <span
                            class="animate-ping absolute  inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-5 w-5 bg-sky-500"></span>
                    </span>
                    <span class="text-gray-500">
                        {{ paymentStatus(invoice[0].payment_status) }} </span>
                </div>


                <span class="text-primary block text-lg text-gray-400"> Order ID : {{ invoice[0].number }} </span>
                <span class="text-primary mb-4 block text-lg font-semibold">
                    Kode Pembayaran
                </span>

                <h2 class="text-dark mb-5 text-[42px] font-bold">
                    {{ invoice[0].payment_code }}
                    <span class="text-body-color text-base font-medium"> / {{ invoice[0].midtra }} </span>
                </h2>

                <div class="mb-7">
                </div>
                
                <Link :href="route('psychologist.payment.chat',invoice[0].number)" 
                    class="text-primary bg-sky-300 text-white hover:bg-white hover:border-sky-300 hover:text-sky-300  block w-full rounded-md border p-4 text-center text-base font-semibold transition ">
                    Chat Client sekarang
                </Link >

                <Polkadot />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['transaction','invoice'],
    methods: {
        paymentStatus(statusId) {
            if (statusId == '1') {
                return 'Menunggu pembayaran';
            }
            if (statusId == '2') {
                return ('Sudah dibayar')
            }
            if (statusId == '3') {
                return ('Kadaluarsa')
            }
        }
    }
}
</script>