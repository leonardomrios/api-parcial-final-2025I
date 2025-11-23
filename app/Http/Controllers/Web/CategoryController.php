<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Muestra el listado paginado de categorías.
     * 
     * FILTRADO: Se implementa desde el BACKEND usando Query Builder de Laravel.
     * - Cuando el usuario escribe en el campo de búsqueda y presiona enter o hace clic en buscar,
     *   se envía un request GET con el parámetro 'search'.
     * - El controlador recibe este parámetro y filtra las categorías usando el método where()
     *   con LIKE para buscar coincidencias parciales en el campo 'category_name'.
     * - Esto es más eficiente que filtrar en el frontend porque:
     *   1. Solo se traen los registros necesarios desde la base de datos
     *   2. Funciona con paginación (solo pagina los resultados filtrados)
     *   3. No carga datos innecesarios en el navegador del cliente
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Obtenemos el término de búsqueda del request (si existe)
        $search = $request->input('search');

        // Construimos la consulta base
        // withCount('computers') agrega un atributo 'computers_count' a cada categoría
        // que contiene la cantidad de computadoras relacionadas SIN hacer N+1 queries
        $query = Category::withCount('computers');

        // Si hay un término de búsqueda, filtramos por nombre
        // FILTRADO BACKEND: Usamos where + LIKE para buscar coincidencias parciales
        if ($search) {
            $query->where('category_name', 'LIKE', "%{$search}%");
        }

        // Ordenamos por ID descendente (más recientes primero) y paginamos
        // La paginación se aplica DESPUÉS del filtro, por lo que solo pagina resultados filtrados
        $categories = $query->orderBy('id_category', 'desc')
                           ->paginate(10) // 10 registros por página
                           ->withQueryString(); // Mantiene los parámetros de búsqueda en los links de paginación

        // Retornamos la vista con las categorías y el término de búsqueda usando Inertia
        return Inertia::render('Categories/Index', [
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    /**
     * Muestra el detalle de una categoría específica.
     * 
     * USO DE RELACIONES ELOQUENT (with y load):
     * - Se usa ->with('computers') para EAGER LOADING (carga anticipada)
     * - Esto trae la categoría Y sus computadoras en UNA SOLA consulta SQL eficiente
     * - Alternativa: $category->load('computers') si ya tenemos la categoría cargada
     * - Evita el problema N+1 (múltiples consultas)
     * 
     * RELACIÓN DEFINIDA EN EL MODELO:
     * - Category->computers() (hasMany)
     * - Definida en app/Models/Category.php
     * 
     * @param Category $category - Route Model Binding automático
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // EAGER LOADING: Cargar la categoría con sus computadoras relacionadas
        // Usando with() para optimizar la consulta (un solo query en lugar de N+1)
        $category->load('computers');
        
        // Alternativa 1: Si no usáramos Route Model Binding:
        // $category = Category::with('computers')->findOrFail($id);
        
        // Alternativa 2: Cargar relaciones después (si ya tenemos la categoría):
        // $category->load('computers');
        
        // Contar computadoras para estadísticas
        $totalComputers = $category->computers->count();
        
        // Retornar vista con la categoría y sus computadoras usando Inertia
        return Inertia::render('Categories/Show', [
            'category' => $category,
            'totalComputers' => $totalComputers,
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Almacena una nueva categoría en la base de datos.
     * 
     * VALIDACIÓN BACKEND:
     * - Se validan todos los campos en el servidor (nunca confiar solo en validación frontend)
     * - Laravel valida automáticamente y retorna errores en formato JSON si es AJAX
     * - Si la validación falla, redirige de vuelta con los errores
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación en el backend (REQUERIDO por seguridad)
        $validated = $request->validate([
            'category_name' => 'required|string|min:3|max:100|unique:categories,category_name',
            'category_description' => 'required|string|min:10|max:1000',
            'category_order' => 'required|integer|min:0|max:9999',
            'category_discount' => 'nullable|numeric|min:0|max:100',
            'estado' => 'required|boolean',
        ], [
            // Mensajes personalizados en español
            'category_name.required' => 'El nombre de la categoría es obligatorio.',
            'category_name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'category_name.max' => 'El nombre no puede exceder 100 caracteres.',
            'category_name.unique' => 'Ya existe una categoría con este nombre.',
            'category_description.required' => 'La descripción es obligatoria.',
            'category_description.min' => 'La descripción debe tener al menos 10 caracteres.',
            'category_description.max' => 'La descripción no puede exceder 1000 caracteres.',
            'category_order.required' => 'El orden es obligatorio.',
            'category_order.integer' => 'El orden debe ser un número entero.',
            'category_order.min' => 'El orden no puede ser negativo.',
            'category_order.max' => 'El orden no puede exceder 9999.',
            'category_discount.numeric' => 'El descuento debe ser un número.',
            'category_discount.min' => 'El descuento no puede ser negativo.',
            'category_discount.max' => 'El descuento no puede exceder 100%.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.boolean' => 'El estado debe ser activo o inactivo.',
        ]);

        try {
            // Crear la categoría
            Category::create($validated);

            // Mensaje de éxito (se muestra en la vista usando session flash)
            return redirect()
                ->route('web.categories.index')
                ->with('success', '¡Categoría creada exitosamente!');
                
        } catch (\Exception $e) {
            // Manejo de errores (por si hay algún problema en la BD)
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear la categoría: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar una categoría existente.
     * 
     * @param Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            'category' => $category,
        ]);
    }

    /**
     * Actualiza una categoría existente en la base de datos.
     * 
     * VALIDACIÓN: Similar a store pero permite el mismo nombre si es la misma categoría
     * 
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        // Validación (permite el mismo nombre si es la misma categoría)
        $validated = $request->validate([
            'category_name' => 'required|string|min:3|max:100|unique:categories,category_name,' . $category->id_category . ',id_category',
            'category_description' => 'required|string|min:10|max:1000',
            'category_order' => 'required|integer|min:0|max:9999',
            'category_discount' => 'nullable|numeric|min:0|max:100',
            'estado' => 'required|boolean',
        ], [
            'category_name.required' => 'El nombre de la categoría es obligatorio.',
            'category_name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'category_name.max' => 'El nombre no puede exceder 100 caracteres.',
            'category_name.unique' => 'Ya existe otra categoría con este nombre.',
            'category_description.required' => 'La descripción es obligatoria.',
            'category_description.min' => 'La descripción debe tener al menos 10 caracteres.',
            'category_description.max' => 'La descripción no puede exceder 1000 caracteres.',
            'category_order.required' => 'El orden es obligatorio.',
            'category_order.integer' => 'El orden debe ser un número entero.',
            'category_order.min' => 'El orden no puede ser negativo.',
            'category_order.max' => 'El orden no puede exceder 9999.',
            'category_discount.numeric' => 'El descuento debe ser un número.',
            'category_discount.min' => 'El descuento no puede ser negativo.',
            'category_discount.max' => 'El descuento no puede exceder 100%.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.boolean' => 'El estado debe ser activo o inactivo.',
        ]);

        try {
            // Actualizar la categoría
            $category->update($validated);

            // Mensaje de éxito
            return redirect()
                ->route('web.categories.index')
                ->with('success', '¡Categoría actualizada exitosamente!');
                
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar la categoría: ' . $e->getMessage());
        }
    }

    /**
     * Elimina una categoría de la base de datos.
     * 
     * VALIDACIÓN: Verifica que no tenga computadoras asociadas antes de eliminar
     * 
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        try {
            // Verificar si tiene computadoras relacionadas
            if ($category->computers()->count() > 0) {
                return redirect()
                    ->route('web.categories.index')
                    ->with('error', 'No se puede eliminar la categoría porque tiene computadoras asociadas.');
            }

            // Eliminar la categoría
            $category->delete();

            // Mensaje de éxito
            return redirect()
                ->route('web.categories.index')
                ->with('success', '¡Categoría eliminada exitosamente!');
                
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()
                ->route('web.categories.index')
                ->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }
}
