<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { getToday } from "@/gettoday"
import { onMounted, computed, ref } from 'vue';

const props = defineProps({
    'errors': Object,
})

const form = useForm({
    purchase_day: '',
    title: '',
    price: '',
    memo: null,
    status: false,
    share_rate: 0,
})

onMounted(() => {
    form.purchase_day = getToday();
})

const open = ref(false);

</script>

<template>

    <Head title="支出登録" />

    <AuthenticatedLayout>
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="form.post(route('expenses.store'), { onSuccess: () => form.reset()})">
                            <div class="container px-5 py-10 mx-auto flex sm:flex-nowrap flex-wrap">
                                <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto md:mr-auto w-full md:py-8 mt-8 md:mt-0">
                                    <h2 class="text-gray-900 text-lg mb-3 font-medium title-font">何にお金を払いましたか?</h2>
                                    <div>
                                        <InputLabel value="購入した日"/>
                                        <TextInput 
                                            id="purchase_day"
                                            type="date"
                                            v-model="form.purchase_day"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="props.errors.purchase_day" />
                                    </div>
                                    <div>
                                        <InputLabel value="品名" class="mt-2"/>
                                        <TextInput 
                                            id="title"
                                            type="text"
                                            v-model="form.title"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="props.errors.title" />
                                    </div>
                                    <div>
                                        <InputLabel value="金額" class="mt-2"/>
                                        <TextInput 
                                            id="price"
                                            type="number"
                                            v-model="form.price"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="props.errors.price" />
                                    </div>
                                    <div class="block mt-2">
                                        <label for="status" class="flex items-center">
                                            <input
                                                id="status"
                                                type="checkbox"
                                                v-model="form.status"
                                                @click="open = !open"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"/>
                                            <span class="ml-2 text-sm text-gray-600">シェアしますか?</span>
                                        </label>
                                    </div>
                                    <div v-show="open" class="mt-2">
                                        <InputLabel value="割合" class="mt-2"/>
                                        <TextInput 
                                            id="share_rate"
                                            type="number"
                                            v-model="form.share_rate"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="props.errors.share_rate" />
                                    </div>
                                    <div class="mb-4">
                                        <InputLabel value="メモ" class="mt-2 mb-2"/>
                                        <textarea name="memo" v-model="form.memo"
                                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                        <InputError class="mt-2" :message="props.errors.memo" />
                                    </div>
                                    <button class="mx-auto lg:w-1/3 text-white bg-amber-500 border-0 py-2 px-1 focus:outline-none hover:bg-amber-600 rounded text-lg">登録</button>
                                    <p class="text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland
                                        tousled brook viral artisan.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>