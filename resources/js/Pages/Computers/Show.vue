<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de Computadora</h2>
                <Link :href="route('web.computers.index')" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-6 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ computer.computer_brand }} {{ computer.computer_model }}</h3>
                                <p class="mt-1 text-sm text-gray-500">ID: {{ computer.id_computer }}</p>
                            </div>
                            <Link :href="route('web.computers.edit', computer.id_computer)" 
                                  class="inline-flex items-center px-3 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Editar
                            </Link>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Marca</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900">{{ computer.computer_brand }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Modelo</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900">{{ computer.computer_model }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900 font-medium">${{ parseFloat(computer.computer_price).toFixed(2) }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">RAM</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900">{{ computer.computer_ram_size }} GB</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <span :class="computer.computer_is_laptop ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'" 
                                          class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                        {{ computer.computer_is_laptop ? '💻 Laptop' : '🖥️ Desktop' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <Link v-if="computer.category" :href="route('web.categories.show', computer.category.id_category)" 
                                          class="text-indigo-600 hover:text-indigo-900">
                                        {{ computer.category.category_name }}
                                    </Link>
                                    <span v-else class="text-gray-400">Sin categoría</span>
                                </div>
                            </div>
                            <div v-if="computer.computer_barcode">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Código de Barras</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900 font-mono">{{ computer.computer_barcode }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();

defineProps({
    computer: Object,
});
</script>

