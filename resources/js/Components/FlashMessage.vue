<template>
    <div v-show="show" 
         :class="[
             'mb-6 px-4 py-3 rounded relative',
             type === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'
         ]" 
         role="alert">
        <div class="flex items-center">
            <svg v-if="type === 'success'" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <svg v-else class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <strong class="font-bold">{{ type === 'success' ? '¡Éxito!' : 'Error:' }}</strong>
            <span class="block sm:inline ml-2">{{ message }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg :class="type === 'success' ? 'fill-current h-6 w-6 text-green-500' : 'fill-current h-6 w-6 text-red-500'" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    type: {
        type: String,
        required: true,
    },
    message: {
        type: String,
        required: true,
    },
});

const show = ref(true);

onMounted(() => {
    setTimeout(() => {
        show.value = false;
    }, 5000);
});
</script>

