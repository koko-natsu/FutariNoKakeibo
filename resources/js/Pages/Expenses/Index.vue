<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    'expenses': Array,
})


</script>

<template>
    <Head title="Expense" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-10">
            <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-10 mx-auto">
                            <div class="flex flex-col text-center w-full mb-10">
                                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">〇月のお支払い</h2>
                                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">説明</p>
                            </div>
                            <div class="lg:w-1/2 mx-auto overflow-auto">
                            <table class="table-auto w-full text-center whitespace-no-wrap">
                                <thead>
                                <tr>
                                    <th class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                                    <th class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                    <th class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">項目</th>
                                    <!-- <th class="px-2 py-2 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メモ</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="expense in expenses" :key="expense.id">
                                    <td class="px-2 py-2 hover:text-amber-400">
                                        <Link :href="route('expenses.show', { expense: expense.id })">
                                            {{ expense.purchase_day }}
                                        </Link>
                                    </td>
                                    <td class="px-2 py-2">{{ expense.price }}</td>
                                    <td class="px-2 py-2">{{ expense.title }}</td>
                                    <!-- <td class="px-4 py-1 text-lg text-gray-900">{{ expense.memo }}</td> -->
                                </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                            <Link as="button" 
                                :href="route('expenses.create')" 
                                class="flex ml-auto text-white bg-amber-500 border-0 py-2 px-6 focus:outline-none hover:bg-amber-600 rounded"
                            >新しい支出</Link>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
