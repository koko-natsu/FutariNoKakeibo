<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import BalanceTable from '@/Components/BalanceTable.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { ref, computed, reactive } from 'vue';
import axios from 'axios';


const props = defineProps({
    'incomes': Array,
    'date': String,
})

const data = reactive({
    'incomes': props.incomes,
    'date': new Date(props.date),
    'month': (new Date(props.date)).getMonth() + 1,
});

const moveMonth = async (num) => {
    const temp = new Date(data.date.setMonth(data.date.getMonth() + num))
    const yyyy = temp.getFullYear();
    const mm   = temp.getMonth() + 1;
    
    try {
        await axios.get(`/api/getIncomes?year=${yyyy}&month=${mm}`)
        .then( res => {
            data.incomes = res.data.incomes
            data.month    = mm
        })
    } catch {
    }
}

const sumPrice = computed(() => {
    let total = 0
    data.incomes.forEach( income => {
        total += income.price
    })
    return total
})

const getMonth = computed(() => {
    return data.month;
})
</script>

<template>
    <Head title="収入" />

    <AuthenticatedLayout>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap -m-12">
                    <div class="p-12 w-full md:w-1/2 flex flex-col items-start">
                        <div class="flex justify-between w-full">
                            <h2 class="ml-5 py-2 sm:text-xl text-2xl title-font font-medium text-gray-900">{{ getMonth }}月の収入</h2>
                            <Link 
                                as="button"
                                :href="route('incomes.create')"
                                id="newButton"
                                class="font-mono text-gray-500 hover:text-gray-700 bg-yellow-400 t-5 px-10 py-2 rounded-lg hover:drop-shadow-lg ">
                                <strong>new</strong>
                            </Link>
                        </div>
                        <div class="flex justify-between w-full px-5 mt-4">
                            <div>
                                <button class="ml-5">
                                    Date
                                    <font-awesome-icon class="mr-2 hover:text-gray-300" :icon="['fas', 'caret-up']" size="xl" />
                                </button>
                                <button class="ml-5">
                                    Price
                                    <font-awesome-icon class="mr-2 hover:text-gray-300" :icon="['fas', 'caret-down']" size="xl" />
                                </button>
                                
                            </div>
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
                                v-for="income in data.incomes"
                                :key="income.id"
                                :balance="income"
                                word="incomes" />
                        </div>
                        <div class="flex justify-end w-full">
                            <div class="bg-white w-full md:w-1/2 mt-5 p-2 rounded-lg box-border border-2 drop-shadow-lg">
                                <div class="flex justify-between mr-5 text-lg text-gray-900">
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
            <svg class="bg-[#FFD966]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 152">
                <path fill="#fefce8" fill-opacity="1" d="M0,96L30,112C60,128,120,160,180,149.3C240,139,300,85,360,69.3C420,53,480,75,540,74.7C600,75,660,53,720,42.7C780,32,840,32,900,48C960,64,1020,96,1080,101.3C1140,107,1200,85,1260,80C1320,75,1380,85,1410,90.7L1440,96L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z" />
            </svg>
            </section>
    </AuthenticatedLayout>
</template>
