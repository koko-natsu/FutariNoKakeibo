<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import BalanceTable from '@/Components/BalanceTable.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const props = defineProps({
    'expenses': Array,
})

const sumPrice = computed(() => {
    let total = 0
    props.expenses.forEach( expense => {
        total += expense.price
    })
    return total
})


</script>

<template>
    <Head title="支出" />

    <AuthenticatedLayout>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="max-w-lg mx-auto p-4 sm:px-5 lg:px-8">
                        <div class="flex justify-end">
                            <Link 
                                as="button"
                                :href="route('expenses.create')"
                                class="block">
                                <font-awesome-icon :icon="['fas', 'plus']" size="xl"/>
                            </Link>
                        </div>
                        <div class="mt-5 rounded-lg divide-y box-border border-2 border-gray-800">
                            <BalanceTable
                            v-for="expense in expenses"
                            :key="expense.id"
                            :balance="expense"
                            word="expenses" />
                        </div>
                        <div class="mt-5 rounded-lg divide-y box-border border-2 border-gray-800">
                            {{ sumPrice }} 
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </AuthenticatedLayout>
</template>
