<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import PschicologistCards from '@/Components/PschicologistCards.vue';
import PaymentHistoryTable from '@/Components/PaymentHistoryTable.vue'
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <PschicologistCards />
                    <PaymentHistoryTable />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
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
