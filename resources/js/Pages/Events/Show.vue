<template>
<MainLayout>
    <div>
        <h1 class="text-2xl font-bold tracking-widest text-black uppercase">{{ event.data.name }}</h1>
        <div>
            <img :src="event.data.image" class="w-full h-64 object-cover mt-4 rounded-lg shadow-lg" />
            <div class="pt-8">
                <span class="flex items-center gap-2 mb-1">
                    <Calendar :size="20" />
                    <span class="font-semibold">Start date:</span>
                    <span class="text-gray-700">{{ event.data.start_datetime }}</span>
                </span>
                <span class="flex items-center gap-2 mb-1">
                    <Clock :size="20" />
                    <span class="font-semibold">Duration:</span>
                    <span class="text-gray-700">{{ event.data.duration }} minutes</span>
                </span>
                <span class="flex items-center gap-2 mb-1">
                    <Users :size="20" />
                    <span class="font-semibold">Capacity:</span>
                    <span class="text-gray-700">{{ event.data.capacity }}</span>
                </span>
                <span class="flex items-center gap-2">
                    <MapPin :size="20" />
                    <span class="font-semibold">Location:</span>
                    <span class="text-gray-700">{{ event.data.location }}</span>
                </span>
            </div>
            <div class="mt-8 prose prose-lg max-w-none wysiwyg-content" v-html="event.data.description"></div>
        </div>
    </div>
</MainLayout>
<div>
    <div class="container mx-auto max-w-7xl px-6 py-8">
        <form class="space-y-4">
            <h2 class="text-2xl font-bold tracking-widest text-black uppercase">Register for this event</h2>

            <div>
                <input
                    type="text"
                    placeholder="Full name"
                    class="p-2 border-2 w-full bg-white focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300"
                />
            </div>
            <div>
                <input
                    type="email"
                    placeholder="E-mail"
                    class="p-2 border-2 w-full bg-white focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300"
                />
            </div>
            <div>
                <input
                    type="tel"
                    placeholder="Phone number"
                    class="p-2 border-2 w-full bg-white focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300"
                />
            </div>

            <div>
                <label class="inline-flex items-center gap-3">
                    <input type="checkbox" class="size-8 rounded" />
                    <span class="font-medium text-gray-700"> I agree to the processing of my personal data (name, email, phone number) by RafEvent for the purpose of event registration, communication regarding the event, and providing event-related services. I understand that I can withdraw my consent at any time by contacting us at <a href="mailto:info@rafevent.com" class="text-blue-500">info@rafevent.com</a>.</span>
                </label>
            </div>

            <div>
                <SubmitBtn label="Register" />
            </div>
        </form>
    </div>
</div>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SubmitBtn from '@/Components/SubmitBtn.vue';
import { Calendar, Clock, Users, MapPin } from 'lucide-vue-next';

const props = defineProps({
  event: {
    type: Object,
    required: true
  }
});
</script>

<style>
.wysiwyg-content h2 {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: .5rem;
}

.wysiwyg-content h2::after {
  content: "";
  display: block;
  width: 50px;
  height: 4px;
  background-color: #7BF1A7;
  margin-top: 0.5rem;
}

.wysiwyg-content h3 {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: .5rem;
}

.wysiwyg-content h3::after {
  content: "";
  display: block;
  width: 40px;
  height: 3px;
  background-color: #7BF1A7;
  margin-top: 0.5rem;
}

.wysiwyg-content p {
  font-size: 1rem;
  margin-bottom: 1rem;
}

.wysiwyg-content ul {
  margin-bottom: .5rem;
}

.wysiwyg-content li::before {
  content: "•";
  font-weight: 800;
  color: #7BF1A7;
  margin-right: 0.5rem;
}

.wysiwyg-content blockquote {
  border-left: 3px solid #7BF1A7;
  padding-left: 1rem;
  margin: 1rem 0;
  font-style: italic;
}

.wysiwyg-content em {
  font-style: italic;
}
</style>
