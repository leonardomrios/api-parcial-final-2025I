<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorías
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Mensajes Flash -->
                <FlashMessage v-if="$page.props.flash?.success" type="success" :message="$page.props.flash.success" />
                <FlashMessage v-if="$page.props.flash?.error" type="error" :message="$page.props.flash.error" />

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <!-- Encabezado con buscador y botón crear -->
                        <div class="mb-6">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div class="flex items-center justify-between w-full sm:w-auto gap-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">
                                            Listado de Categorías
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            Total de registros: {{ categories.total }}
                                        </p>
                                    </div>
                                    
                                    <Link :href="route('web.categories.create')" 
                                          class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Nueva Categoría
                                    </Link>
                                </div>

                                <!-- Buscador -->
                                <div class="w-full sm:w-auto">
                                    <form @submit.prevent="search" class="flex gap-2">
                                        <input 
                                            v-model="searchTerm"
                                            type="text" 
                                            placeholder="Buscar por nombre..." 
                                            class="block w-full sm:w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                        >
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Buscar
                                        </button>
                                        <Link 
                                            v-if="search"
                                            :href="route('web.categories.index')" 
                                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Limpiar
                                        </Link>
                                    </form>
                                </div>
                            </div>

                            <div v-if="search" class="mt-4 bg-blue-50 border border-blue-200 rounded-md p-3">
                                <p class="text-sm text-blue-800">
                                    Mostrando resultados para: <strong>"{{ search }}"</strong>
                                    ({{ categories.total }} {{ categories.total === 1 ? 'resultado' : 'resultados' }})
                                </p>
                            </div>
                        </div>

                        <!-- Tabla de categorías -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descuento</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Computadoras</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="category in categories.data" :key="category.id_category" class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ category.id_category }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <Link :href="route('web.categories.show', category.id_category)" class="font-medium text-indigo-600 hover:text-indigo-900 hover:underline">
                                                {{ category.category_name }}
                                            </Link>
                                            <div v-if="category.category_description" class="text-xs text-gray-500 mt-1">
                                                {{ category.category_description.substring(0, 50) }}{{ category.category_description.length > 50 ? '...' : '' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span :class="category.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" 
                                                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                                                {{ category.estado ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                #{{ category.category_order }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span v-if="category.category_discount" 
                                                  class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{ parseFloat(category.category_discount).toFixed(2) }}%
                                            </span>
                                            <span v-else class="text-gray-400 text-xs">Sin descuento</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                            <Link :href="route('web.categories.show', category.id_category)" 
                                                  :class="category.computers_count > 0 ? 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200' : 'bg-gray-100 text-gray-500'"
                                                  class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg font-semibold text-sm transition-colors duration-150">
                                                {{ category.computers_count }}
                                            </Link>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <Link :href="route('web.categories.show', category.id_category)" 
                                                      class="inline-flex items-center justify-center p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105"
                                                      title="Ver detalle">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </Link>
                                                
                                                <Link :href="route('web.categories.edit', category.id_category)" 
                                                      class="inline-flex items-center justify-center p-2 bg-black hover:bg-gray-800 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105"
                                                      title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </Link>
                                                
                                                <form @submit.prevent="deleteCategory(category)" class="inline-block">
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
                                    <tr v-if="categories.data.length === 0">
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="mt-4 text-sm text-gray-500">
                                                    {{ search ? `No se encontraron categorías que coincidan con "${search}"` : 'No hay categorías registradas' }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div v-if="categories.links && categories.links.length > 3" class="mt-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    <Link v-if="categories.prev_page_url" :href="categories.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Anterior
                                    </Link>
                                    <Link v-if="categories.next_page_url" :href="categories.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Siguiente
                                    </Link>
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Mostrando
                                            <span class="font-medium">{{ categories.from }}</span>
                                            a
                                            <span class="font-medium">{{ categories.to }}</span>
                                            de
                                            <span class="font-medium">{{ categories.total }}</span>
                                            resultados
                                        </p>
                                    </div>
                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                            <Link v-for="(link, index) in categories.links" :key="index" 
                                                  :href="link.url || '#'" 
                                                  :class="[
                                                      'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                                      link.active 
                                                          ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' 
                                                          : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                                      !link.url ? 'cursor-not-allowed opacity-50' : ''
                                                  ]"
                                                  v-html="link.label">
                                            </Link>
                                        </nav>
                                    </div>
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
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { useRoute } from '@/composables/useRoute';

const { route } = useRoute();

const props = defineProps({
    categories: Object,
    search: String,
});

const searchTerm = ref(props.search || '');

const search = () => {
    router.get(route('web.categories.index'), { search: searchTerm.value }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const deleteCategory = (category) => {
    if (confirm(`¿Estás seguro de que deseas eliminar la categoría '${category.category_name}'?\n\nEsta acción no se puede deshacer.`)) {
        router.delete(route('web.categories.destroy', category.id_category));
    }
};
</script>

