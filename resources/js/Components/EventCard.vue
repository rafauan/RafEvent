<template>
    <div class="border-2 cursor-pointer hover:-translate-x-1 hover:-translate-y-1 transition-transform duration-300">
        <img :src="item.image" class="w-full h-48 object-cover" />
        <div class="mt-4 px-4 pb-4">
            <span class="inline-block bg-green-300 text-gray-800 px-2 py-1 mb-2.5 rounded-full text-xs font-bold uppercase tracking-wide">
                {{ item.category }}
            </span>
            <h3 class="text-sm font-bold tracking-widest text-black uppercase">{{ item.name }}</h3>
            <p class="mt-1 text-gray-600">{{ item.excerpt }}</p>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});
</script>
