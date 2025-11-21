{{-- 
    Vista de listado de categorías con autenticación
    
    CARACTERÍSTICAS:
    - Usa el layout de Jetstream (x-app-layout) para usuarios autenticados
    - Muestra un listado paginado de categorías
    - Incluye buscador con filtrado desde el BACKEND
    - Campos mostrados: ID, Nombre, Estado, Orden, Descuento
    - Diseño responsivo con Tailwind CSS
--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                {{-- Contenedor principal con padding --}}
                <div class="p-6">
                    
                    {{-- Encabezado con buscador --}}
                    <div class="mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            
                            {{-- Título --}}
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    Listado de Categorías
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    Total de registros: {{ $categories->total() }}
                                </p>
                            </div>

                            {{-- 
                                BUSCADOR CON FILTRADO BACKEND:
                                - El formulario envía un GET request con el parámetro 'search'
                                - El controlador recibe este parámetro y filtra en la BD
                                - Se mantiene el valor en el input después de buscar con old() o $search
                            --}}
                            <div class="w-full sm:w-auto">
                                <form method="GET" action="{{ route('web.categories.index') }}" class="flex gap-2">
                                    <input 
                                        type="text" 
                                        name="search" 
                                        value="{{ $search ?? '' }}"
                                        placeholder="Buscar por nombre..." 
                                        class="block w-full sm:w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    >
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Buscar
                                    </button>
                                    @if($search)
                                        <a 
                                            href="{{ route('web.categories.index') }}" 
                                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        >
                                            Limpiar
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>

                        {{-- Mensaje cuando hay búsqueda activa --}}
                        @if($search)
                            <div class="mt-4 bg-blue-50 border border-blue-200 rounded-md p-3">
                                <p class="text-sm text-blue-800">
                                    Mostrando resultados para: <strong>"{{ $search }}"</strong>
                                    ({{ $categories->total() }} {{ $categories->total() == 1 ? 'resultado' : 'resultados' }})
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- Tabla de categorías --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Orden
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descuento
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($categories as $category)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        {{-- ID --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $category->id_category }}
                                        </td>
                                        
                                        {{-- Nombre --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="font-medium">{{ $category->category_name }}</div>
                                            @if($category->category_description)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ Str::limit($category->category_description, 50) }}
                                                </div>
                                            @endif
                                        </td>
                                        
                                        {{-- Estado --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($category->estado)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Activo
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Inactivo
                                                </span>
                                            @endif
                                        </td>
                                        
                                        {{-- Orden (Campo adicional 1) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                                #{{ $category->category_order }}
                                            </span>
                                        </td>
                                        
                                        {{-- Descuento (Campo adicional 2) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($category->category_discount)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    {{ number_format($category->category_discount, 2) }}%
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">Sin descuento</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="mt-4 text-sm text-gray-500">
                                                    @if($search)
                                                        No se encontraron categorías que coincidan con "{{ $search }}"
                                                    @else
                                                        No hay categorías registradas
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- 
                        PAGINACIÓN:
                        - Laravel genera automáticamente los links de paginación
                        - withQueryString() mantiene los parámetros de búsqueda al cambiar de página
                        - El estilo se adapta al diseño de Tailwind CSS usado en Jetstream
                    --}}
                    @if($categories->hasPages())
                        <div class="mt-6">
                            {{ $categories->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

