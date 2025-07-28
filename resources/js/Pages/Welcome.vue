<template>
    <nav class="mx-auto flex tems-center justify-between px-6 py-4">
        <h1 class="text-3xl font-bold tracking-wider">
            RafEvent
        </h1>
        <a class="group relative inline-block focus:outline-hidden" href="#">
          <span
            class="absolute inset-0 translate-x-1.5 translate-y-1.5 bg-green-300 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"
          ></span>

          <span
            class="relative inline-block border-2 border-current px-8 py-3 text-sm font-bold tracking-widest text-black uppercase"
          >
            Login
          </span>
        </a>
    </nav>
    <div class="px-6">
        <div>
            <h2 class="text-2xl font-bold tracking-wider">Welcome to RafEvent</h2>
            <p>Your one-stop solution for event management.</p>
        </div>

        <div class="flex justify-between gap-4">
            <input v-model="searchName" type="text" placeholder="Search events..." class="mt-4 p-2 border-2 w-full focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300" />
            <select
                v-model="selectedCategory"
                class="mt-4 p-2 border-2 w-full focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300">
                <option value="">Select Category</option>
                <option
                    v-for="category in categories.data"
                    :key="category.id"
                    :value="category.name"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <EventCard
                v-for="event in filteredEvents"
                :key="event.id"
                :item="event"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, toRefs } from 'vue';
import EventCard from '@/Components/EventCard.vue';
// import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    events: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});

const { events, categories } = toRefs(props);

const selectedCategory = ref('');
const searchName = ref('');

const filteredEvents = computed(() => {
  return events.value.data
    .filter(evt =>
      // pasuje kategoria albo nic nie wybrano
      (!selectedCategory.value || evt.category === selectedCategory.value)
    )
    .filter(evt =>
      // pasuje nazwa albo nic nie wpisano
      (!searchName.value ||
        evt.name.toLowerCase().includes(searchName.value.toLowerCase())
      )
    )
})


</script>
