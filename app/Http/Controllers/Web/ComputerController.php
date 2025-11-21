<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use App\Models\Category;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    /**
     * Muestra el listado paginado de computadoras con búsqueda.
     * 
     * FILTRADO BACKEND: Búsqueda por marca o modelo
     * EAGER LOADING: Carga la categoría relacionada para evitar N+1
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Computer::with('category'); // Eager loading de la categoría
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('computer_brand', 'LIKE', "%{$search}%")
                  ->orWhere('computer_model', 'LIKE', "%{$search}%");
            });
        }
        
        $computers = $query->orderBy('id_computer', 'desc')
                          ->paginate(10)
                          ->withQueryString();
        
        return view('computers.index', compact('computers', 'search'));
    }

    /**
     * Muestra el detalle de una computadora con su categoría relacionada.
     * 
     * EAGER LOADING: Carga la categoría relacionada
     */
    public function show(Computer $computer)
    {
        $computer->load('category');
        
        return view('computers.show', compact('computer'));
    }

    /**
     * Muestra el formulario para crear una nueva computadora.
     */
    public function create()
    {
        // Obtener solo categorías activas para el select
        $categories = Category::where('estado', true)
                             ->orderBy('category_name')
                             ->get();
        
        return view('computers.create', compact('categories'));
    }

    /**
     * Almacena una nueva computadora en la base de datos.
     * 
     * VALIDACIÓN: Frontend (HTML5) y Backend (Laravel)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'computer_brand' => 'required|string|min:2|max:100',
            'computer_model' => 'required|string|min:2|max:100',
            'computer_price' => 'required|numeric|min:0|max:999999.99',
            'computer_ram_size' => 'required|integer|min:1|max:512',
            'computer_is_laptop' => 'required|boolean',
            'category_id' => 'required|exists:categories,id_category',
            'computer_barcode' => 'nullable|string|max:50|unique:computers,computer_barcode',
        ], [
            'computer_brand.required' => 'La marca es obligatoria.',
            'computer_brand.min' => 'La marca debe tener al menos 2 caracteres.',
            'computer_brand.max' => 'La marca no puede exceder 100 caracteres.',
            'computer_model.required' => 'El modelo es obligatorio.',
            'computer_model.min' => 'El modelo debe tener al menos 2 caracteres.',
            'computer_model.max' => 'El modelo no puede exceder 100 caracteres.',
            'computer_price.required' => 'El precio es obligatorio.',
            'computer_price.numeric' => 'El precio debe ser un número.',
            'computer_price.min' => 'El precio no puede ser negativo.',
            'computer_price.max' => 'El precio no puede exceder 999,999.99.',
            'computer_ram_size.required' => 'La memoria RAM es obligatoria.',
            'computer_ram_size.integer' => 'La RAM debe ser un número entero.',
            'computer_ram_size.min' => 'La RAM debe ser al menos 1 GB.',
            'computer_ram_size.max' => 'La RAM no puede exceder 512 GB.',
            'computer_is_laptop.required' => 'Debe especificar si es laptop o desktop.',
            'computer_is_laptop.boolean' => 'El tipo debe ser laptop o desktop.',
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'computer_barcode.unique' => 'Este código de barras ya está registrado.',
            'computer_barcode.max' => 'El código no puede exceder 50 caracteres.',
        ]);

        try {
            Computer::create($validated);

            return redirect()
                ->route('web.computers.index')
                ->with('success', '¡Computadora creada exitosamente!');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear la computadora: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar una computadora.
     */
    public function edit(Computer $computer)
    {
        $categories = Category::where('estado', true)
                             ->orderBy('category_name')
                             ->get();
        
        return view('computers.edit', compact('computer', 'categories'));
    }

    /**
     * Actualiza una computadora existente.
     */
    public function update(Request $request, Computer $computer)
    {
        $validated = $request->validate([
            'computer_brand' => 'required|string|min:2|max:100',
            'computer_model' => 'required|string|min:2|max:100',
            'computer_price' => 'required|numeric|min:0|max:999999.99',
            'computer_ram_size' => 'required|integer|min:1|max:512',
            'computer_is_laptop' => 'required|boolean',
            'category_id' => 'required|exists:categories,id_category',
            'computer_barcode' => 'nullable|string|max:50|unique:computers,computer_barcode,' . $computer->id_computer . ',id_computer',
        ], [
            'computer_brand.required' => 'La marca es obligatoria.',
            'computer_brand.min' => 'La marca debe tener al menos 2 caracteres.',
            'computer_brand.max' => 'La marca no puede exceder 100 caracteres.',
            'computer_model.required' => 'El modelo es obligatorio.',
            'computer_model.min' => 'El modelo debe tener al menos 2 caracteres.',
            'computer_model.max' => 'El modelo no puede exceder 100 caracteres.',
            'computer_price.required' => 'El precio es obligatorio.',
            'computer_price.numeric' => 'El precio debe ser un número.',
            'computer_price.min' => 'El precio no puede ser negativo.',
            'computer_price.max' => 'El precio no puede exceder 999,999.99.',
            'computer_ram_size.required' => 'La memoria RAM es obligatoria.',
            'computer_ram_size.integer' => 'La RAM debe ser un número entero.',
            'computer_ram_size.min' => 'La RAM debe ser al menos 1 GB.',
            'computer_ram_size.max' => 'La RAM no puede exceder 512 GB.',
            'computer_is_laptop.required' => 'Debe especificar si es laptop o desktop.',
            'computer_is_laptop.boolean' => 'El tipo debe ser laptop o desktop.',
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'computer_barcode.unique' => 'Este código de barras ya está registrado.',
            'computer_barcode.max' => 'El código no puede exceder 50 caracteres.',
        ]);

        try {
            $computer->update($validated);

            return redirect()
                ->route('web.computers.index')
                ->with('success', '¡Computadora actualizada exitosamente!');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar la computadora: ' . $e->getMessage());
        }
    }

    /**
     * Elimina una computadora de la base de datos.
     */
    public function destroy(Computer $computer)
    {
        try {
            $computer->delete();

            return redirect()
                ->route('web.computers.index')
                ->with('success', '¡Computadora eliminada exitosamente!');
                
        } catch (\Exception $e) {
            return redirect()
                ->route('web.computers.index')
                ->with('error', 'Error al eliminar la computadora: ' . $e->getMessage());
        }
    }
}
