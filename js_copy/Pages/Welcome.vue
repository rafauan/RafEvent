<template>
    <MainLayout>
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
            <div
                v-for="event in filteredEvents"
                :key="event.id"
                @click="goToEvent(event.id)"
            >
                <EventCard :item="event" />
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { ref, reactive, computed, toRefs } from 'vue';
// import { useRoute } from 'vue-router';
import EventCard from '@/Components/EventCard.vue';
import MainLayout from '@/Layouts/MainLayout.vue';

function goToEvent(id) {
    router.visit(`/events/${id}`);
}

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
