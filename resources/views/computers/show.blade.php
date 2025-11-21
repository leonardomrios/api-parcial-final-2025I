<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de Computadora</h2>
            <a href="{{ route('web.computers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Información Principal --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $computer->computer_brand }} {{ $computer->computer_model }}</h3>
                            <p class="text-sm text-gray-500 mt-1">ID: #{{ $computer->id_computer }}</p>
                        </div>
                        <div>
                            @if($computer->computer_is_laptop)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    💻 Laptop
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    🖥️ Desktop
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Marca</p>
                                <p class="text-lg text-gray-900">{{ $computer->computer_brand }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Modelo</p>
                                <p class="text-lg text-gray-900">{{ $computer->computer_model }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Memoria RAM</p>
                                <p class="text-lg text-gray-900">{{ $computer->computer_ram_size }} GB</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Precio</p>
                                <p class="text-2xl font-bold text-green-600">${{ number_format($computer->computer_price, 2) }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Código de Barras</p>
                                <p class="text-lg text-gray-900">{{ $computer->computer_barcode ?? 'No especificado' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Tipo de Equipo</p>
                                <p class="text-lg text-gray-900">{{ $computer->computer_is_laptop ? 'Laptop / Portátil' : 'Desktop / Escritorio' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t mt-6 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Fecha de Creación</p>
                                <p class="text-base text-gray-900">{{ $computer->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-600">Última Actualización</p>
                                <p class="text-base text-gray-900">{{ $computer->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t">
                        <a href="{{ route('web.computers.edit', $computer->id_computer) }}" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar
                        </a>
                        <form method="POST" action="{{ route('web.computers.destroy', $computer->id_computer) }}" class="inline-block"
                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta computadora? Esta acción no se puede deshacer.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Información de Categoría Relacionada (EAGER LOADING) --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Categoría
                    </h4>

                    @if($computer->category)
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-4 border border-indigo-200">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h5 class="text-xl font-semibold text-indigo-900">
                                        {{ $computer->category->category_name }}
                                        @if($computer->category->estado)
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                ✓ Activa
                                            </span>
                                        @else
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                ✗ Inactiva
                                            </span>
                                        @endif
                                    </h5>
                                    <p class="text-sm text-gray-600 mt-2">{{ $computer->category->category_description ?? 'Sin descripción' }}</p>
                                    
                                    <div class="flex items-center space-x-4 mt-4">
                                        <div class="text-sm">
                                            <span class="font-semibold text-gray-700">Orden:</span>
                                            <span class="ml-1 px-2 py-0.5 bg-gray-200 rounded">{{ $computer->category->category_order }}</span>
                                        </div>
                                        <div class="text-sm">
                                            <span class="font-semibold text-gray-700">Descuento:</span>
                                            <span class="ml-1 px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded font-medium">
                                                {{ $computer->category->category_discount }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('web.categories.show', $computer->category->id_category) }}" 
                                    class="ml-4 inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                                    Ver Categoría
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.166 2.307-1.166 2.98 0l5.58 9.662c.673 1.166-.17 2.606-1.49 2.606H4.395c-1.32 0-2.163-1.44-1.49-2.606l5.58-9.662zM10 11a1 1 0 100-2 1 1 0 000 2zm-1 4a1 1 0 102 0 1 1 0 00-2 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">Esta computadora no tiene una categoría asignada.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

