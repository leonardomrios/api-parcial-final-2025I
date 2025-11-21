{{-- 
    Formulario de creación de categorías
    
    VALIDACIÓN FRONTEND (HTML5):
    - required: Campo obligatorio
    - minlength/maxlength: Longitud mínima y máxima
    - min/max: Valores mínimos y máximos para números
    - step: Incremento permitido para decimales
    - pattern: Expresión regular para validación
    
    VALIDACIÓN BACKEND:
    - Se valida en el controlador (CategoryController@store)
    - Laravel retorna errores automáticamente si la validación falla
    - Los errores se muestran usando @error
--}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Categoría') }}
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
                    
                    {{-- Formulario con validación HTML5 (FRONTEND) --}}
                    <form method="POST" action="{{ route('web.categories.store') }}" class="space-y-6">
                        @csrf

                        {{-- Nombre de la Categoría --}}
                        <div>
                            <label for="category_name" class="block text-sm font-medium text-gray-700">
                                Nombre de la Categoría <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="category_name" 
                                id="category_name" 
                                value="{{ old('category_name') }}"
                                required
                                minlength="3"
                                maxlength="100"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_name') border-red-500 @enderror"
                                placeholder="Ej: Laptops Gaming"
                            >
                            <p class="mt-1 text-xs text-gray-500">Mínimo 3 caracteres, máximo 100</p>
                            
                            {{-- ERROR DE VALIDACIÓN BACKEND --}}
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
                                placeholder="Describe la categoría..."
                            >{{ old('category_description') }}</textarea>
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
                                value="{{ old('category_order', 0) }}"
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
                                value="{{ old('category_discount') }}"
                                min="0"
                                max="100"
                                step="0.01"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_discount') border-red-500 @enderror"
                                placeholder="0.00"
                            >
                            <p class="mt-1 text-xs text-gray-500">Descuento opcional (0-100%). Ejemplo: 15.50</p>
                            
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
                                        {{ old('estado', '1') == '1' ? 'checked' : '' }}
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
                                        {{ old('estado') == '0' ? 'checked' : '' }}
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
                                Crear Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tarjeta de Ayuda --}}
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Información sobre la validación</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Validación Frontend (HTML5):</strong> Se valida en el navegador antes de enviar</li>
                                <li><strong>Validación Backend (Laravel):</strong> Se valida en el servidor por seguridad</li>
                                <li>Los campos con <span class="text-red-500">*</span> son obligatorios</li>
                                <li>Los errores se muestran debajo de cada campo</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

