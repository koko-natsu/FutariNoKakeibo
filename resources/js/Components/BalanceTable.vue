<script setup>
import { defineProps, onMounted } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Inertia } from '@inertiajs/inertia';

defineProps({
  balance: Object,
  word: String,
})

const deleteItem = (id, word) => {
    if(word == 'incomes') {
        Inertia.delete(route('incomes.destroy', { income: id}), {
            onBefore: () => confirm('本当に削除しますか？')
        })
    } else {
        Inertia.delete(route('expenses.destroy', { expense: id}), {
            onBefore: () => confirm('本当に削除しますか？')
        })
    }
}
</script>

<template>
<div class="p-2">
  <div class="flex-1">
      <div class="relative flex justify-between items-center">
          <div class="font-mono max-w-xs truncate">
              <small v-if="word == 'expenses'" class="ml-2 text-gray-800 text-sm">{{ balance.purchase_day }}</small>
              <small v-else class="ml-2 text-gray-800 text-sm">{{ balance.receive_date }}</small>
              <span class="ml-5 inline-block py-1 px-2 rounded bg-indigo-50 text-indigo-500 text-xs font-medium tracking-widest">CATEGORY</span>
              <div class="mt-1 ml-3 text-gray-900">{{ balance.title }}</div>
          </div>
          <div class="truncate">
              <strong class="mr-10 text-lg text-gray-900">{{ balance.price.toLocaleString() }}</strong>
          </div>
          <div class="absolute top-0 right-2">
              <Dropdown v-if="balance.user_id === $page.props.auth.user.id">
                  <template #trigger>
                      <button>
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                          </svg>
                      </button>
                  </template>
                  <template #content>
                    <div v-if="word == 'expenses'">
                      <DropdownLink as="button" :href="route('expenses.edit', balance.id)" method="get">
                          Edit
                      </DropdownLink>
                      <button @click="deleteItem(balance.id, word)" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        Delete
                      </button>
                    </div>
                    <div v-if="word == 'incomes'">
                      <DropdownLink as="button" :href="route('incomes.edit', balance.id)" method="get">
                          Edit
                      </DropdownLink>
                      <button @click="deleteItem(balance.id, word)" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        Delete
                      </button>
                    </div>
                  </template>
              </Dropdown>
              <div v-show="balance.memo">
                <font-awesome-icon icon="fa-regular fa-clipboard" />
              </div>
          </div>
      </div>
  </div>
</div>
</template>