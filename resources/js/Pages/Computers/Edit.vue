<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Computadora</h2>
                <Link :href="route('web.computers.index')" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label for="computer_brand" class="block text-sm font-medium text-gray-700">Marca <span class="text-red-500">*</span></label>
                                <input v-model="form.computer_brand" type="text" id="computer_brand" required minlength="2" maxlength="100"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       :class="{ 'border-red-500': errors.computer_brand }">
                                <p v-if="errors.computer_brand" class="mt-2 text-sm text-red-600">{{ errors.computer_brand }}</p>
                            </div>

                            <div>
                                <label for="computer_model" class="block text-sm font-medium text-gray-700">Modelo <span class="text-red-500">*</span></label>
                                <input v-model="form.computer_model" type="text" id="computer_model" required minlength="2" maxlength="100"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       :class="{ 'border-red-500': errors.computer_model }">
                                <p v-if="errors.computer_model" class="mt-2 text-sm text-red-600">{{ errors.computer_model }}</p>
                            </div>

                            <div>
                                <label for="computer_price" class="block text-sm font-medium text-gray-700">Precio <span class="text-red-500">*</span></label>
                                <input v-model.number="form.computer_price" type="number" id="computer_price" required min="0" max="999999.99" step="0.01"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       :class="{ 'border-red-500': errors.computer_price }">
                                <p v-if="errors.computer_price" class="mt-2 text-sm text-red-600">{{ errors.computer_price }}</p>
                            </div>

                            <div>
                                <label for="computer_ram_size" class="block text-sm font-medium text-gray-700">RAM (GB) <span class="text-red-500">*</span></label>
                                <input v-model.number="form.computer_ram_size" type="number" id="computer_ram_size" required min="1" max="512"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       :class="{ 'border-red-500': errors.computer_ram_size }">
                                <p v-if="errors.computer_ram_size" class="mt-2 text-sm text-red-600">{{ errors.computer_ram_size }}</p>
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría <span class="text-red-500">*</span></label>
                                <select v-model.number="form.category_id" id="category_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        :class="{ 'border-red-500': errors.category_id }">
                                    <option value="">Seleccione una categoría</option>
                                    <option v-for="category in categories" :key="category.id_category" :value="category.id_category">
                                        {{ category.category_name }}
                                    </option>
                                </select>
                                <p v-if="errors.category_id" class="mt-2 text-sm text-red-600">{{ errors.category_id }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo <span class="text-red-500">*</span></label>
                                <div class="flex items-center space-x-6">
                                    <label class="flex items-center">
                                        <input v-model="form.computer_is_laptop" type="radio" :value="true" required class="rounded-full border-gray-300 text-indigo-600">
                                        <span class="ml-2 text-sm text-gray-700">Laptop</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input v-model="form.computer_is_laptop" type="radio" :value="false" class="rounded-full border-gray-300 text-indigo-600">
                                        <span class="ml-2 text-sm text-gray-700">Desktop</span>
                                    </label>
                                </div>
                                <p v-if="errors.computer_is_laptop" class="mt-2 text-sm text-red-600">{{ errors.computer_is_laptop }}</p>
                            </div>

                            <div>
                                <label for="computer_barcode" class="block text-sm font-medium text-gray-700">Código de Barras</label>
                                <input v-model="form.computer_barcode" type="text" id="computer_barcode" maxlength="50"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       :class="{ 'border-red-500': errors.computer_barcode }">
                                <p v-if="errors.computer_barcode" class="mt-2 text-sm text-red-600">{{ errors.computer_barcode }}</p>
                            </div>

                            <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                                <Link :href="route('web.computers.index')" 
                                      class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                    Cancelar
                                </Link>
                                <button type="submit" :disabled="form.processing"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 disabled:opacity-50">
                                    Actualizar Computadora
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
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();

const props = defineProps({
    computer: Object,
    categories: Array,
    errors: Object,
});

const form = useForm({
    computer_brand: props.computer.computer_brand,
    computer_model: props.computer.computer_model,
    computer_price: props.computer.computer_price,
    computer_ram_size: props.computer.computer_ram_size,
    computer_is_laptop: props.computer.computer_is_laptop,
    category_id: props.computer.category_id,
    computer_barcode: props.computer.computer_barcode,
});

const submit = () => {
    form.put(route('web.computers.update', props.computer.id_computer));
};
</script>

