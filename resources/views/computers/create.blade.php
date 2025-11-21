<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Computadora</h2>
            <a href="{{ route('web.computers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
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
                    <form method="POST" action="{{ route('web.computers.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="computer_brand" class="block text-sm font-medium text-gray-700">Marca <span class="text-red-500">*</span></label>
                            <input type="text" name="computer_brand" id="computer_brand" value="{{ old('computer_brand') }}"
                                required minlength="2" maxlength="100"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('computer_brand') border-red-500 @enderror"
                                placeholder="Ej: Dell, HP, Lenovo">
                            <p class="mt-1 text-xs text-gray-500">Mínimo 2 caracteres, máximo 100</p>
                            @error('computer_brand')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="computer_model" class="block text-sm font-medium text-gray-700">Modelo <span class="text-red-500">*</span></label>
                            <input type="text" name="computer_model" id="computer_model" value="{{ old('computer_model') }}"
                                required minlength="2" maxlength="100"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('computer_model') border-red-500 @enderror"
                                placeholder="Ej: XPS 15, Pavilion">
                            <p class="mt-1 text-xs text-gray-500">Mínimo 2 caracteres, máximo 100</p>
                            @error('computer_model')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category_id') border-red-500 @enderror">
                                <option value="">Seleccione una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_category }}" {{ old('category_id') == $category->id_category ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Seleccione la categoría a la que pertenece</p>
                            @error('category_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="computer_ram_size" class="block text-sm font-medium text-gray-700">RAM (GB) <span class="text-red-500">*</span></label>
                                <input type="number" name="computer_ram_size" id="computer_ram_size" value="{{ old('computer_ram_size') }}"
                                    required min="1" max="512"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('computer_ram_size') border-red-500 @enderror"
                                    placeholder="8">
                                <p class="mt-1 text-xs text-gray-500">Entre 1 y 512 GB</p>
                                @error('computer_ram_size')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="computer_price" class="block text-sm font-medium text-gray-700">Precio <span class="text-red-500">*</span></label>
                                <input type="number" name="computer_price" id="computer_price" value="{{ old('computer_price') }}"
                                    required min="0" max="999999.99" step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('computer_price') border-red-500 @enderror"
                                    placeholder="1500.00">
                                <p class="mt-1 text-xs text-gray-500">Precio en dólares</p>
                                @error('computer_price')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="computer_barcode" class="block text-sm font-medium text-gray-700">Código de Barras</label>
                            <input type="text" name="computer_barcode" id="computer_barcode" value="{{ old('computer_barcode') }}"
                                maxlength="50"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('computer_barcode') border-red-500 @enderror"
                                placeholder="123456789012">
                            <p class="mt-1 text-xs text-gray-500">Opcional, máximo 50 caracteres, debe ser único</p>
                            @error('computer_barcode')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="computer_is_laptop" class="block text-sm font-medium text-gray-700 mb-2">Tipo <span class="text-red-500">*</span></label>
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center">
                                    <input type="radio" name="computer_is_laptop" value="1" {{ old('computer_is_laptop', '0') == '1' ? 'checked' : '' }} required
                                        class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            💻 Laptop
                                        </span>
                                    </span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="computer_is_laptop" value="0" {{ old('computer_is_laptop', '0') == '0' ? 'checked' : '' }}
                                        class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            🖥️ Desktop
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @error('computer_is_laptop')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                            <a href="{{ route('web.computers.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                Cancelar
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Crear Computadora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

