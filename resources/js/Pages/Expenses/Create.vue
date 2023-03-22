<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head } from '@inertiajs/vue3';
import { getToday } from "@/gettoday"
import { reactive, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  'user_id': Number,
  'errors': Object,
})

const form = reactive({
  user_id: props.user_id,
  purchase_day: '',
  title: '',
  price: '',
  memo:  null,
})

onMounted(() => {
  form.purchase_day = getToday();
})

const storeExpense = () => {
  Inertia.post('/expenses', form)
}

</script>

<template>
    <Head title="支出登録" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <section class="text-gray-600 body-font relative">
                    <form @submit.prevent="storeExpense">
                        <div class="container px-5 py-10 mx-auto flex sm:flex-nowrap flex-wrap">
                          <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto md:mr-auto w-full md:py-8 mt-8 md:mt-0">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">何にお金を払いましたか?</h2>
                            <p class="leading-relaxed mb-5 text-gray-600">説明</p>
                            <div class="relative mb-4">
                              <label for="purchase_day" class="leading-7 text-sm text-gray-600">購入した日</label>
                              <input type="date" id="purchase_day" name="purchase_day" v-model="form.purchase_day" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              <InputError class="mt-2" :message="props.errors.purchase_day" />
                            </div>
                            <div class="relative mb-4">
                              <label for="title" class="leading-7 text-sm text-gray-600">品名</label>
                              <input type="text" id="title" name="title" v-model="form.title" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              <InputError class="mt-2" :message="props.errors.title" />
                            </div>
                            <div class="relative mb-4">
                              <label for="price" class="leading-7 text-sm text-gray-600">金額</label>
                              <input type="number" id="price" name="price" v-model="form.price" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              <InputError class="mt-2" :message="props.errors.price" />
                            </div>
                            <div class="relative mb-4">
                              <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
                              <textarea id="memo" name="memo" v-model="form.memo" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                              <InputError class="mt-2" :message="props.errors.memo" />
                            </div>
                            <button class="mx-auto lg:w-1/3 text-white bg-amber-500 border-0 py-2 px-1 focus:outline-none hover:bg-amber-600 rounded text-lg">登録</button>
                            <p class="text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p>
                          </div>
                        </div>
                      </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
