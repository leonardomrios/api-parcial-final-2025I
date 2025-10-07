<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('category')->id_category;
        
        return [
            'category_name' => 'required|string|max:100|unique:categories,category_name,' . $categoryId . ',id_category',
            'category_description' => 'required|string',
            'category_order' => 'integer|min:0',
            'category_discount' => 'nullable|numeric|min:0|max:999.99',
            'estado' => 'boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'category_name.required' => 'El nombre de la categoría es requerido.',
            'category_name.unique' => 'Ya existe una categoría con ese nombre.',
            'category_description.required' => 'La descripción es requerida.',
            'category_order.min' => 'El orden debe ser mayor o igual a 0.',
            'category_discount.max' => 'El descuento no puede ser mayor a 999.99.',
        ];
    }
}
