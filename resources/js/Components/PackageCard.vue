<template>
    <div class="my-3 h-screen flex justify-center items-center bg-gray-400 antialiased text-gray-900">

        <button @click="$emit('showPsychology')" class="group relative h-12 w-48 overflow-hidden rounded-lg bg-white text-lg shadow">
            <div class="absolute inset-0 w-3 bg-amber-400 transition-all duration-[250ms] ease-out group-hover:w-full"></div>
            <span class="relative text-black group-hover:text-white">Kembali</span>
        </button>

        <div v-for="PackageCard in packages" class="mx-4 cursor-pointer" @click="fetchPackages(PackageCard.id)">
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

                    <h4 class="mt-1 text-xl font-semibold uppercase leading-tight truncate"> {{ PackageCard.psychologist_id }} </h4>

                    <div class="mt-1">
                        Rp{{ PackageCard.price }}
                        <span class="text-gray-600 text-sm"> /wk</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-teal-600 text-md font-semibold">4/5 ratings </span>
                        <span class="text-sm text-gray-600">(based on 234 ratings)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : ["packages"]
}
</script>
