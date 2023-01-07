<script setup>
import PackagesCard from '@/Components/PackageCard.vue'
</script>

<template>
    <div class="my-3 mx-[100px] h-screen flex justify-center items-center antialiased text-white">
        <div class="mx-[20px]" v-show="!showPackage" v-for="psychologist in psychologists">
            <div class="p-8 bg-blue-300 shadow mt-24">
                <div class="">
                    <div class="relative">
                        <div class="bg-[url('psy-1.webp')] bg-cover w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                        </div>
                    </div>
                </div>
                <div class="mt-[120px] text-center border-b pb-12">
                    <h1 class="text-[20px] font-medium text-white">
                        {{ psychologist.name }}, 
                    </h1>
                    <p class="mt-2 text-white">University of Computer Science</p>
                </div>
                <div class="mt-12 flex flex-col justify-center">
                    <ul>
                        <li>ahli di bidang konsultasi pantering</li>
                        <li>mempunyai 120 pasien</li>
                        <li>ahli dalam mengenai masalah pernikahan</li>
                    </ul>
                    <button @click="fetchPackages(psychologist.id)" class="text-white mt-[48px] py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        Pesan
                    </button>
                </div>
            </div>
        </div>
        <PackagesCard @show-psychology="showPsychology()" v-show="showPackage" :packages=packages></PackagesCard>
    </div>
</template>
<script>

export default {
    data() {
        return {
            psychologists: [],
            packages: [],
            showPackage: false
        }
    },
    methods: {
        fetchPackages(idPsychologist) {
            axios.get(`/fetch/packages/${idPsychologist}`)
                .then(response => {
                    this.packages = response.data.packages;
                })
            this.showPackage = true
        },
        showPsychology() {
            this.showPackage = false;
            this.packages = [];
        }
    },
    mounted() {
        axios.get('/fetch/psychologists/')
            .then(response => {
                this.psychologists = response.data.psychologists;
            })
    }
}
</script>
