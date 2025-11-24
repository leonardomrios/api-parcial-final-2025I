<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Computadoras
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FlashMessage v-if="$page.props.flash?.success" type="success" :message="$page.props.flash.success" />
                <FlashMessage v-if="$page.props.flash?.error" type="error" :message="$page.props.flash.error" />

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-6">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div class="flex items-center justify-between w-full sm:w-auto gap-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">Listado de Computadoras</h3>
                                        <p class="mt-1 text-sm text-gray-600">Total: {{ computers.total }} registros</p>
                                    </div>
                                    <Link :href="route('web.computers.create')" 
                                          class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-700">
                                        Nueva Computadora
                                    </Link>
                                </div>

                                <div class="w-full sm:w-auto">
                                    <form @submit.prevent="search" class="flex gap-2">
                                        <input v-model="searchTerm" type="text" placeholder="Buscar por marca o modelo..." 
                                               class="block w-full sm:w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                            Buscar
                                        </button>
                                        <Link v-if="search" :href="route('web.computers.index')" 
                                              class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                                            Limpiar
                                        </Link>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marca/Modelo</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">RAM</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="computer in computers.data" :key="computer.id_computer" class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ computer.id_computer }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <Link :href="route('web.computers.show', computer.id_computer)" class="font-medium text-indigo-600 hover:text-indigo-900">
                                                {{ computer.computer_brand }}
                                            </Link>
                                            <div class="text-xs text-gray-500">{{ computer.computer_model }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <Link v-if="computer.category" :href="route('web.categories.show', computer.category.id_category)" 
                                                  class="text-indigo-600 hover:text-indigo-900">
                                                {{ computer.category.category_name }}
                                            </Link>
                                            <span v-else class="text-gray-400">Sin categoría</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ computer.computer_ram_size }} GB</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${{ parseFloat(computer.computer_price).toFixed(2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span :class="computer.computer_is_laptop ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'" 
                                                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                                                {{ computer.computer_is_laptop ? '💻 Laptop' : '🖥️ Desktop' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <!-- Botón Ver Detalle -->
                                                <Link :href="route('web.computers.show', computer.id_computer)" 
                                                      class="inline-flex items-center justify-center p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105"
                                                      title="Ver detalle">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </Link>
                                                
                                                <!-- Botón Editar -->
                                                <Link :href="route('web.computers.edit', computer.id_computer)" 
                                                      class="inline-flex items-center justify-center p-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105"
                                                      title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </Link>
                                                
                                                <!-- Botón Eliminar con CONFIRMACIÓN -->
                                                <form @submit.prevent="deleteComputer(computer)" class="inline-block">
                                                    <button 
                                                        type="submit" 
                                                        class="inline-flex items-center justify-center p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105"
                                                        title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación simplificada -->
                        <div v-if="computers.links && computers.links.length > 3" class="mt-6 flex justify-center">
                            <div class="flex space-x-2">
                                <Link v-for="(link, index) in computers.links" :key="index" 
                                      :href="link.url || '#'" 
                                      :class="[
                                          'px-4 py-2 border rounded-md text-sm',
                                          link.active ? 'bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                          !link.url ? 'cursor-not-allowed opacity-50' : ''
                                      ]"
                                      v-html="link.label">
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();

const props = defineProps({
    computers: Object,
    search: String,
});

const searchTerm = ref(props.search || '');

const search = () => {
    router.get(route('web.computers.index'), { search: searchTerm.value }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const deleteComputer = (computer) => {
    if (confirm(`¿Estás seguro de que deseas eliminar la computadora ${computer.computer_brand} ${computer.computer_model}?`)) {
        router.delete(route('web.computers.destroy', computer.id_computer));
    }
};
</script>

