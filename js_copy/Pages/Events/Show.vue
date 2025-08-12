<template>
<MainLayout>
    <div>
        <div v-if="successMessage" class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ successMessage }}
        </div>
        <div v-if="errors">
            {{ errors }}
        </div>
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

    <!-- Registration Form -->
    <div class="container mx-auto max-w-7xl py-8">
        <form class="space-y-4" @submit.prevent="signUp">
            <!-- Błędy ogólne (capacity, email already registered) -->
            <div v-if="form.errors.capacity || errors.capacity" class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                {{ form.errors.capacity || errors.capacity }}
            </div>

            <h2 class="text-2xl font-bold tracking-widest text-black uppercase">Register for this event</h2>

            <div>
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Full name"
                    class="p-2 border-2 w-full bg-white focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300"
                />
                <div v-if="errors.email" class="text-red-500 text-sm mt-1">
                    {{ errors.email[0] }}
                </div>
            </div>
            <div>
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="E-mail"
                    class="p-2 border-2 w-full bg-white focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300"
                />
                <div v-if="errors.email" class="text-red-500 text-sm mt-1">
                    {{ errors.email[0] }}
                </div>
            </div>
            <div>
                <input
                    v-model="form.phone"
                    type="tel"
                    placeholder="Phone number"
                    class="p-2 border-2 w-full bg-white focus:outline-none focus:-translate-x-1 focus:-translate-y-1 transition-transform duration-300"
                />
                <div v-if="errors.phone" class="text-red-500 text-sm mt-1">
                    {{ errors.phone[0] }}
                </div>
            </div>

            <div>
                <label class="inline-flex items-center gap-3">
                    <input v-model="form.agree" type="checkbox" class="size-8 rounded" />
                    <span class="font-medium text-gray-700"> I agree to the processing of my personal data (name, email, phone number) by RafEvent for the purpose of event registration, communication regarding the event, and providing event-related services. I understand that I can withdraw my consent at any time by contacting us at <a href="mailto:info@rafevent.com" class="text-blue-500">info@rafevent.com</a>.</span>
                </label>
                <div v-if="errors.agree" class="text-red-500 text-sm mt-1">{{ errors.agree[0] }}</div>
            </div>

            {{ form }}

            <div>
                <SubmitBtn />
            </div>
        </form>
    </div>
</MainLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue';
import SubmitBtn from '@/Components/SubmitBtn.vue';
import { Calendar, Clock, Users, MapPin } from 'lucide-vue-next';

const page = usePage();
const successMessage = computed(() => page.props.flash?.success);
const errors = computed(() => page.props.flash?.errors || {});

const props = defineProps({
  event: {
    type: Object,
    required: true
  }
});

// Form
const form = useForm({
    event_id: props.event.data.id,
    name: '',
    email: '',
    phone: '',
    agree: false
})

const signUp = () => {
    form.post('/events/register', {
        onSuccess: () => {
            console.log('Success! Resetting form...');
            form.reset();
        },
        onError: (errors) => {
            form.setError(errors);
            console.error('Error during registration:', errors);
        }
    });
}
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
