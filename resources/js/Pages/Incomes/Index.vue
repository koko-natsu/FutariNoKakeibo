<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import BalanceTable from '@/Components/BalanceTable.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const props = defineProps({
    'incomes': Array,
})


</script>

<template>
    <Head title="収入" />

    <AuthenticatedLayout>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="max-w-lg mx-auto p-4 sm:px-5 lg:px-8">
                        <div class="flex justify-end">
                            <Link 
                                as="button"
                                :href="route('incomes.create')"
                                class="block">
                                <font-awesome-icon :icon="['fas', 'plus']" size="xl"/>
                            </Link>
                        </div>
                        <div class="mt-5 rounded-lg divide-y box-border border-2 border-gray-800">
                            <BalanceTable
                            v-for="income in incomes"
                            :key="income.id"
                            :balance="income"
                            word="incomes" />
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </AuthenticatedLayout>
</template>
