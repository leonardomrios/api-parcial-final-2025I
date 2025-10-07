<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComputerRequest extends FormRequest
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
        return [
            'computer_brand' => 'required|string|max:255',
            'computer_model' => 'required|string|max:255',
            'computer_price' => 'required|numeric|min:0',
            'computer_ram_size' => 'required|integer|min:1',
            'computer_is_laptop' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id_category',
            'computer_barcode' => 'nullable|string|max:255|unique:computers,computer_barcode',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'computer_barcode.unique' => 'Este código de barras ya está en uso.',
        ];
    }
}
