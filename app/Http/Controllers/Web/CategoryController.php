<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
        $query = Category::query();

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

        // Retornamos la vista con las categorías y el término de búsqueda
        return view('categories.index', compact('categories', 'search'));
    }
}
