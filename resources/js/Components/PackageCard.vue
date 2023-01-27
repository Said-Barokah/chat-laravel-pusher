<script setup>
import Polkadot from '@/Components/Polkadot.vue'
</script>
<template>
    <div class="my-3 h-screen flex justify-center items-center antialiased text-gray-900">

        <button @click="$emit('showPsychology')"
            class="group relative h-12 w-48 overflow-hidden rounded-lg bg-white text-lg shadow">
            <div class="absolute inset-0 w-3 bg-amber-400 transition-all duration-[250ms] ease-out group-hover:w-full">
            </div>
            <span class="relative text-black group-hover:text-white">Kembali</span>
        </button>

        <div class="w-full px-4 md:w-1/2 lg:w-1/3" v-for="PackageCard in packages">
            <div
                class="border-primary shadow-pricing relative z-10 mb-10 overflow-hidden rounded-xl border border-opacity-20 bg-white py-10 px-8 sm:p-12 lg:py-10 lg:px-6 xl:p-12">
                <span class="text-primary mb-4 block text-lg font-semibold">
                    {{ PackageCard.pack_name }}
                </span>
                <h2 class="text-dark mb-5 text-[42px] font-bold">
                    {{ PackageCard.price }}
                    <span class="text-body-color text-base font-medium"> / sesi </span>
                </h2>
                <p class="text-body-color mb-8 border-b border-[#F2F2F2] pb-8 text-base">
                    Perfect for using in a personal website or a client project.
                </p>
                <div class="mb-7">
                    <p class="text-body-color mb-1 text-base leading-loose">1 User</p>
                    <p class="text-body-color mb-1 text-base leading-loose">
                        All UI components
                    </p>
                    <p class="text-body-color mb-1 text-base leading-loose">
                        Lifetime access
                    </p>
                    <p class="text-body-color mb-1 text-base leading-loose">
                        Free updates
                    </p>
                    <p class="text-body-color mb-1 text-base leading-loose">
                        Use on 1 (one) project
                    </p>
                    <p class="text-body-color mb-1 text-base leading-loose">
                        3 Months support
                    </p>
                </div>
                <button @click="snapToken(PackageCard.id)"
                    class="text-primary hover:bg-primary hover:border-primary block w-full rounded-md border border-[#D4DEFF] bg-transparent p-4 text-center text-base font-semibold transition hover:text-white">
                    Pesan Sekarang
                </button>
                <Polkadot />
                
            </div>
        </div>

        
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ["packages"],
    methods: {
        snapToken(packageId) {
            axios.get(`/payment/package/${packageId}`).then(response => {
                window.snap.pay(response.data.token, {
                    onSuccess: function (result) {
                        /* You may add your own implementation here */
                        alert("payment success!"); console.log(result);
                    },
                    onPending: function (result) {
                        axios.post(`/payment/package/${packageId}`, result)
                        alert("wating your payment!"); console.log(result);
                    },
                    onError: function (result) {
                        /* You may add your own implementation here */
                        alert("payment failed!"); console.log(result);
                    },
                    onClose: function () {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            })
        }
    }
}
</script>
