<template>
    <div class="group relative inline-block focus:outline-hidden cursor-pointer" @click="$emit('click')">
      <span
        class="absolute inset-0 translate-x-1.5 translate-y-1.5 bg-green-300 transition-transform group-hover:translate-x-0 group-hover:translate-y-0"
      ></span>

      <span
        class="relative inline-block border-2 border-current px-8 py-3 text-sm font-bold tracking-widest text-black uppercase"
      >
        {{ label }}
      </span>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  label: {
    type: String,
    default: 'Submit'
  }
});

const emit = defineEmits(['click']);
</script>
