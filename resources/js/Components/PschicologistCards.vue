<script setup>
import PackagesCard from '@/Components/PackageCard.vue'
</script>
<template>
    <div class="my-3 h-screen flex justify-center items-center bg-gray-400 antialiased text-gray-900">
        <div v-show="!showPackage" v-for="psychologist in psychologists" class="mx-4 cursor-pointer" @click="fetchPackages(psychologist.id)">
            <img src="https://source.unsplash.com/random/350x350" alt=" random imgee"
                class="w-full object-cover object-center rounded-lg shadow-md">
            <div class="relative px-4 -mt-16  ">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-baseline">
                        <span
                            class="bg-teal-200 text-teal-800 text-xs px-2 inline-block rounded-full  uppercase font-semibold tracking-wide">
                            New
                        </span>
                        <div class="ml-2 text-gray-600 uppercase text-xs font-semibold tracking-wider">
                            2 baths &bull; 3 rooms
                        </div>
                    </div>

                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate"> {{ psychologist.name }} </h4>

                    <div class="mt-1">
                        $1800
                        <span class="text-gray-600 text-sm"> /wk</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-teal-600 text-md font-semibold">4/5 ratings </span>
                        <span class="text-sm text-gray-600">(based on 234 ratings)</span>
                    </div>
                </div>
            </div>
        </div>
        <PackagesCard @show-psychology="showPsychology()" v-show="showPackage" :packages=packages></PackagesCard>
    </div>
</template>
<script>

export default {
    data(){
        return {
            psychologists : [],
            packages : [],
            showPackage : false
        }
    },
    methods : {
        fetchPackages(idPsychologist){
            axios.get(`/fetch/packages/${idPsychologist}`)
                .then(response => {
                    this.packages = response.data.packages;
                })
            this.showPackage = true
        },
        showPsychology(){
            this.showPackage = false;
            this.packages = [];
        }
    },
    mounted(){
        axios.get('/fetch/psychologists/')
                .then(response => {
                    this.psychologists = response.data.psychologists;
                })
    }
}
</script>
