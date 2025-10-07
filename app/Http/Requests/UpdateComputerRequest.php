<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComputerRequest extends FormRequest
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
        $computerId = $this->route('computer')->id_computer;
        
        return [
            'computer_brand' => 'sometimes|required|string|max:255',
            'computer_model' => 'sometimes|required|string|max:255',
            'computer_price' => 'sometimes|required|numeric|min:0',
            'computer_ram_size' => 'sometimes|required|integer|min:1',
            'computer_is_laptop' => 'sometimes|required|boolean',
            'category_id' => 'nullable|exists:categories,id_category',
            'computer_barcode' => 'nullable|string|max:255|unique:computers,computer_barcode,' . $computerId . ',id_computer',
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
