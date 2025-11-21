{{-- 
    Formulario de edición de categorías
    
    Similar al formulario de creación pero con datos prellenados
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Categoría') }}
            </h2>
            <a href="{{ route('web.categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    
                    {{-- Información de la categoría --}}
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Editando categoría:</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ $category->category_name }}</p>
                        <p class="text-xs text-gray-500 mt-1">ID: {{ $category->id_category }}</p>
                    </div>

                    {{-- Formulario con validación HTML5 y método PUT --}}
                    <form method="POST" action="{{ route('web.categories.update', $category->id_category) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Nombre de la Categoría --}}
                        <div>
                            <label for="category_name" class="block text-sm font-medium text-gray-700">
                                Nombre de la Categoría <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="category_name" 
                                id="category_name" 
                                value="{{ old('category_name', $category->category_name) }}"
                                required
                                minlength="3"
                                maxlength="100"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_name') border-red-500 @enderror"
                            >
                            <p class="mt-1 text-xs text-gray-500">Mínimo 3 caracteres, máximo 100</p>
                            
                            @error('category_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descripción --}}
                        <div>
                            <label for="category_description" class="block text-sm font-medium text-gray-700">
                                Descripción <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="category_description" 
                                id="category_description" 
                                rows="4"
                                required
                                minlength="10"
                                maxlength="1000"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_description') border-red-500 @enderror"
                            >{{ old('category_description', $category->category_description) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Mínimo 10 caracteres, máximo 1000</p>
                            
                            @error('category_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Orden --}}
                        <div>
                            <label for="category_order" class="block text-sm font-medium text-gray-700">
                                Orden <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="category_order" 
                                id="category_order" 
                                value="{{ old('category_order', $category->category_order) }}"
                                required
                                min="0"
                                max="9999"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_order') border-red-500 @enderror"
                            >
                            <p class="mt-1 text-xs text-gray-500">Orden de visualización (0-9999)</p>
                            
                            @error('category_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descuento --}}
                        <div>
                            <label for="category_discount" class="block text-sm font-medium text-gray-700">
                                Descuento (%)
                            </label>
                            <input 
                                type="number" 
                                name="category_discount" 
                                id="category_discount" 
                                value="{{ old('category_discount', $category->category_discount) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_discount') border-red-500 @enderror"
                            >
                            <p class="mt-1 text-xs text-gray-500">Descuento opcional (0-100%)</p>
                            
                            @error('category_discount')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center">
                                    <input 
                                        type="radio" 
                                        name="estado" 
                                        value="1" 
                                        {{ old('estado', $category->estado) == '1' ? 'checked' : '' }}
                                        required
                                        class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                    <span class="ml-2 text-sm text-gray-700">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </span>
                                </label>
                                
                                <label class="flex items-center">
                                    <input 
                                        type="radio" 
                                        name="estado" 
                                        value="0" 
                                        {{ old('estado', $category->estado) == '0' ? 'checked' : '' }}
                                        class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                    <span class="ml-2 text-sm text-gray-700">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    </span>
                                </label>
                            </div>
                            
                            @error('estado')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                            <a 
                                href="{{ route('web.categories.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Cancelar
                            </a>
                            
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Actualizar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

