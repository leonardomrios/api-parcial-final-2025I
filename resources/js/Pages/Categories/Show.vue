<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detalle de Categoría
                </h2>
                <Link :href="route('web.categories.index')" 
                      class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver al Listado
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Información de la categoría -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-6 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ category.category_name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">ID: {{ category.id_category }}</p>
                            </div>
                            <Link :href="route('web.categories.edit', category.id_category)" 
                                  class="inline-flex items-center px-3 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                Editar
                            </Link>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900 whitespace-pre-line">{{ category.category_description }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <span :class="category.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" 
                                          class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                        {{ category.estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Orden</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-base font-semibold bg-gray-200 text-gray-800">
                                        #{{ category.category_order }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descuento</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <span v-if="category.category_discount" 
                                          class="inline-flex items-center px-3 py-1 rounded-md text-base font-semibold bg-yellow-100 text-yellow-800">
                                        {{ parseFloat(category.category_discount).toFixed(2) }}%
                                    </span>
                                    <span v-else class="text-gray-400 text-sm">Sin descuento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Computadoras relacionadas -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Computadoras Asociadas ({{ totalComputers }})
                        </h3>
                        <div v-if="category.computers && category.computers.length > 0" class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marca</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modelo</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">RAM</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="computer in category.computers" :key="computer.id_computer">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ computer.id_computer }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ computer.computer_brand }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ computer.computer_model }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ computer.computer_ram_size }} GB</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${{ parseFloat(computer.computer_price).toFixed(2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else class="text-center py-12">
                            <p class="text-sm text-gray-500">Esta categoría aún no tiene computadoras asociadas.</p>
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
    category: Object,
    totalComputers: Number,
});
</script>

