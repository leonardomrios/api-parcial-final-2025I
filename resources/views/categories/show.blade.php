{{-- 
    Vista de detalle de categoría con registros relacionados
    
    CARACTERÍSTICAS:
    - Muestra toda la información de la categoría
    - Usa EAGER LOADING (with/load) para cargar computadoras relacionadas
    - Muestra listado de computadoras asociadas
    - Evita problema N+1 (consultas múltiples innecesarias)
    - Diseño limpio con tarjetas (cards)
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle de Categoría') }}
            </h2>
            <a href="{{ route('web.categories.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- 
                TARJETA 1: INFORMACIÓN COMPLETA DE LA CATEGORÍA
                Muestra todos los campos de la categoría de forma clara y organizada
            --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    {{-- Encabezado de la tarjeta --}}
                    <div class="flex items-start justify-between mb-6 pb-4 border-b border-gray-200">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-2xl font-bold text-gray-900">
                                    {{ $category->category_name }}
                                </h3>
                                {{-- Badge de estado --}}
                                @if($category->estado)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="mr-1.5 h-2.5 w-2.5 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="mr-1.5 h-2.5 w-2.5 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Inactivo
                                    </span>
                                @endif
                            </div>
                            <p class="mt-1 text-sm text-gray-500">ID: {{ $category->id_category }}</p>
                        </div>

                        {{-- Botones de acción rápida --}}
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('web.categories.edit', $category->id_category) }}" 
                               class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                        </div>
                    </div>

                    {{-- Grid con información de la categoría --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Descripción --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Descripción
                            </label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-900 whitespace-pre-line">{{ $category->category_description }}</p>
                            </div>
                        </div>

                        {{-- Orden --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Orden de Visualización
                            </label>
                            <div class="bg-gray-50 rounded-lg p-4 flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-base font-semibold bg-gray-200 text-gray-800">
                                    #{{ $category->category_order }}
                                </span>
                            </div>
                        </div>

                        {{-- Descuento --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Descuento Aplicable
                            </label>
                            <div class="bg-gray-50 rounded-lg p-4 flex items-center">
                                @if($category->category_discount)
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-base font-semibold bg-yellow-100 text-yellow-800">
                                        {{ number_format($category->category_discount, 2) }}%
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">Sin descuento</span>
                                @endif
                            </div>
                        </div>

                        {{-- Fechas --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de Creación
                            </label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-900">{{ $category->created_at->format('d/m/Y H:i:s') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $category->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Última Actualización
                            </label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-900">{{ $category->updated_at->format('d/m/Y H:i:s') }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $category->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 
                TARJETA 2: ESTADÍSTICAS
                Muestra información resumida sobre las computadoras relacionadas
            --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Estadísticas</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Total de computadoras --}}
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-600 font-medium">Total de Computadoras</p>
                                    <p class="text-3xl font-bold text-blue-900 mt-2">{{ $totalComputers }}</p>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Estado de la categoría --}}
                        <div class="{{ $category->estado ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} rounded-lg p-4 border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm {{ $category->estado ? 'text-green-600' : 'text-red-600' }} font-medium">Estado</p>
                                    <p class="text-2xl font-bold {{ $category->estado ? 'text-green-900' : 'text-red-900' }} mt-2">
                                        {{ $category->estado ? 'Activo' : 'Inactivo' }}
                                    </p>
                                </div>
                                <div class="p-3 {{ $category->estado ? 'bg-green-100' : 'bg-red-100' }} rounded-full">
                                    <svg class="w-8 h-8 {{ $category->estado ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($category->estado)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        @endif
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Descuento --}}
                        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-yellow-600 font-medium">Descuento</p>
                                    <p class="text-3xl font-bold text-yellow-900 mt-2">
                                        {{ $category->category_discount ? number_format($category->category_discount, 1) . '%' : 'N/A' }}
                                    </p>
                                </div>
                                <div class="p-3 bg-yellow-100 rounded-full">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 
                TARJETA 3: COMPUTADORAS RELACIONADAS
                Muestra el listado de computadoras que pertenecen a esta categoría
                
                EAGER LOADING IMPLEMENTADO:
                - En el controlador se usa: $category->load('computers')
                - Esto carga todas las computadoras en una sola consulta SQL
                - Evita el problema N+1 (ejecutar una consulta por cada computadora)
                - $category->computers ya está disponible sin consultas adicionales
            --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Computadoras Asociadas
                            <span class="ml-2 text-sm font-normal text-gray-500">({{ $totalComputers }} {{ $totalComputers == 1 ? 'registro' : 'registros' }})</span>
                        </h3>
                    </div>

                    @if($category->computers->count() > 0)
                        {{-- Tabla de computadoras --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Marca
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Modelo
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            RAM
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Precio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    {{-- 
                                        ITERACIÓN SOBRE RELACIÓN CARGADA:
                                        $category->computers proviene del eager loading
                                        No se ejecutan consultas adicionales aquí
                                    --}}
                                    @foreach($category->computers as $computer)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $computer->id_computer }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $computer->computer_brand }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $computer->computer_model }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $computer->computer_ram_size }} GB
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                ${{ number_format($computer->computer_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @if($computer->computer_is_laptop)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        💻 Laptop
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        🖥️ Desktop
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                                                {{ $computer->computer_barcode ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Mensaje cuando no hay computadoras --}}
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay computadoras</h3>
                            <p class="mt-1 text-sm text-gray-500">Esta categoría aún no tiene computadoras asociadas.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tarjeta informativa sobre Eager Loading --}}
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Eager Loading Implementado</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>En el controlador:</strong> Se usa <code class="bg-blue-100 px-1 rounded">$category->load('computers')</code></li>
                                <li><strong>Beneficio:</strong> Se cargan las computadoras en una sola consulta SQL</li>
                                <li><strong>Evita:</strong> Problema N+1 (múltiples consultas innecesarias)</li>
                                <li><strong>Resultado:</strong> Mejor rendimiento y velocidad de carga</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
