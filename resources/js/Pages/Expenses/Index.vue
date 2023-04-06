<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed, reactive } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import BalanceTable from '@/Components/BalanceTable.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import axios from 'axios';

const props = defineProps({
    'expenses': Array,
    'date': String,
})

const data = reactive({
    'expenses': props.expenses,
    'date': new Date(props.date),
    'month': (new Date(props.date)).getMonth() + 1,
});


const moveMonth = async (num) => {
    const temp = new Date(data.date.setMonth(data.date.getMonth() + num))
    const yyyy = temp.getFullYear();
    const mm   = temp.getMonth() + 1;
    
    try {
        await axios.get(`/api/getExpenses?year=${yyyy}&month=${mm}`)
        .then( res => {
            data.expenses = res.data.expenses
            data.month    = mm
        })
    } catch {
    }
}

const sumPrice = computed(() => {
    let total = 0
    data.expenses.forEach( expense => {
        total += expense.price
    })
    return total
})

const getMonth = computed(() => {
    let mm = data.month;
    return mm
})
</script>

<template>
    <Head title="支出" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap -m-12">
                    <div class="p-12 w-full md:w-1/2 flex flex-col items-start">
                        <div class="flex justify-between w-full">
                            <h2 class="ml-5 py-2 sm:text-xl text-2xl title-font font-medium text-gray-900">{{ getMonth }}月のお支払い</h2>
                            <Link 
                                as="button"
                                :href="route('expenses.create')"
                                id="newButton"
                                class="font-mono text-gray-500 hover:text-gray-700 bg-yellow-400 t-5 px-10 py-2 rounded-lg hover:drop-shadow-lg ">
                                <strong>new</strong>
                            </Link>
                        </div>
                        <div class="flex justify-end w-full px-5 mt-4">
                            <div>
                                <button @click="moveMonth(-1)">
                                    <font-awesome-icon class="mr-2 hover:text-gray-300" :icon="['fas', 'caret-left']" size="xl" />
                                </button>
                                <button @click="moveMonth(1)">
                                    <font-awesome-icon class="hover:text-gray-300" :icon="['fas', 'caret-right']" size="xl" />
                                </button>
                            </div>
                        </div>
                        <div id="scrollbar" class="bg-white box-border border-3 w-full max-h-96 mt-5 rounded-lg divide-y overflow-y-auto drop-shadow-lg">
                            <BalanceTable
                                v-for="expense in data.expenses"
                                :key="expense.id"
                                :balance="expense"
                                word="expenses" />
                        </div>
                        <div class="flex justify-end w-full">
                            <div class="bg-white w-full md:w-1/2 mt-5 p-2 rounded-lg box-border border-2 drop-shadow-lg">
                                <div class="flex justify-between mr-10 text-lg text-gray-900">
                                    <strong class="font-mono ml-2">total</strong>
                                    <strong class="font-mono">{{ sumPrice.toLocaleString() }} 円</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-12 md:w-1/2 flex flex-col items-start">
                        <span class="inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest">CATEGORY</span>
                        <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">Pinterest DIY dreamcatcher gentrify single-origin coffee</h2>
                        <p class="leading-relaxed mb-8">Live-edge letterpress cliche, salvia fanny pack humblebrag narwhal portland. VHS man braid palo santo hoodie brunch trust fund. Bitters hashtag waistcoat fashion axe chia unicorn. Plaid fixie chambray 90's, slow-carb etsy tumeric.</p>
                        <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
                            <a class="text-indigo-500 inline-flex items-center">Learn More
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <span class="text-gray-400 mr-3 inline-flex items-center ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                                </svg>1.2K
                            </span>
                            <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>6
                            </span>
                        </div>
                        <a class="inline-flex items-center">
                            <img alt="blog" src="https://dummyimage.com/103x103" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                            <span class="flex-grow flex flex-col pl-4">
                                <span class="title-font font-medium text-gray-900">Alper Kamu</span>
                                <span class="text-gray-400 text-xs tracking-widest mt-0.5">DESIGNER</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style>
#scrollbar::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

#scrollbar::-webkit-scrollbar-track {
 border-radius: 5px;
 background: rgba(110, 108, 108, 0.2);
}

#scrollbar::-webkit-scrollbar-thumb {
 border-radius: 10px;
 background: rgb(255, 217, 102);
}
</style>
