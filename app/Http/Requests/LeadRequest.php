<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'max:14'],
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
            'email.required' => 'Email di perlukan',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email harus berupa email',
            'email.max' => 'Email maksimum 255 karakter',
            'phone_number.required' => 'Nomor Telepon di perlukan',
            'phone_number.string' => 'Nomor Telepon harus berupa string',
            'phone_number.max' => 'Nomor Telepon maksimum 255 karakter',
        ];
    }
}
