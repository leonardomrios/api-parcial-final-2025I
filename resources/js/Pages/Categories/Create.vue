<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Crear Categoría
                </h2>
                <Link :href="route('web.categories.index')" 
                      class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver al Listado
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Nombre -->
                            <div>
                                <label for="category_name" class="block text-sm font-medium text-gray-700">
                                    Nombre de la Categoría <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    v-model="form.category_name"
                                    type="text" 
                                    id="category_name" 
                                    required
                                    minlength="3"
                                    maxlength="100"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': errors.category_name }"
                                >
                                <p v-if="errors.category_name" class="mt-2 text-sm text-red-600">{{ errors.category_name }}</p>
                                <p class="mt-1 text-xs text-gray-500">Mínimo 3 caracteres, máximo 100</p>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="category_description" class="block text-sm font-medium text-gray-700">
                                    Descripción <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    v-model="form.category_description"
                                    id="category_description" 
                                    rows="4"
                                    required
                                    minlength="10"
                                    maxlength="1000"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': errors.category_description }"
                                ></textarea>
                                <p v-if="errors.category_description" class="mt-2 text-sm text-red-600">{{ errors.category_description }}</p>
                                <p class="mt-1 text-xs text-gray-500">Mínimo 10 caracteres, máximo 1000</p>
                            </div>

                            <!-- Orden -->
                            <div>
                                <label for="category_order" class="block text-sm font-medium text-gray-700">
                                    Orden <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    v-model.number="form.category_order"
                                    type="number" 
                                    id="category_order" 
                                    required
                                    min="0"
                                    max="9999"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': errors.category_order }"
                                >
                                <p v-if="errors.category_order" class="mt-2 text-sm text-red-600">{{ errors.category_order }}</p>
                            </div>

                            <!-- Descuento -->
                            <div>
                                <label for="category_discount" class="block text-sm font-medium text-gray-700">
                                    Descuento (%)
                                </label>
                                <input 
                                    v-model.number="form.category_discount"
                                    type="number" 
                                    id="category_discount" 
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': errors.category_discount }"
                                >
                                <p v-if="errors.category_discount" class="mt-2 text-sm text-red-600">{{ errors.category_discount }}</p>
                            </div>

                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Estado <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center space-x-6">
                                    <label class="flex items-center">
                                        <input 
                                            v-model="form.estado"
                                            type="radio" 
                                            :value="true"
                                            required
                                            class="rounded-full border-gray-300 text-indigo-600"
                                        >
                                        <span class="ml-2 text-sm text-gray-700">Activo</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input 
                                            v-model="form.estado"
                                            type="radio" 
                                            :value="false"
                                            class="rounded-full border-gray-300 text-indigo-600"
                                        >
                                        <span class="ml-2 text-sm text-gray-700">Inactivo</span>
                                    </label>
                                </div>
                                <p v-if="errors.estado" class="mt-2 text-sm text-red-600">{{ errors.estado }}</p>
                            </div>

                            <!-- Botones -->
                            <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                                <Link :href="route('web.categories.index')" 
                                      class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                    Cancelar
                                </Link>
                                <button 
                                    type="submit" 
                                    :disabled="processing"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 disabled:opacity-50">
                                    Crear Categoría
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { reactive } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();

const form = useForm({
    category_name: '',
    category_description: '',
    category_order: 0,
    category_discount: null,
    estado: true,
});

const props = defineProps({
    errors: Object,
});

const submit = () => {
    form.post(route('web.categories.store'));
};

const processing = form.processing;
</script>

