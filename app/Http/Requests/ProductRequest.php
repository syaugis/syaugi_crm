<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name di perlukan',
            'name.string' => 'Name harus berupa string',
            'name.max' => 'Name maksimum 255 karakter',
            'description.string' => 'Deskripsi harus berupa string',
            'price.required' => 'Harga di perlukan',
            'price.numeric' => 'Harga harus berupa angka',
        ];
    }
}
