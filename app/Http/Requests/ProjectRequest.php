<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
            'lead_id'    => ['required', 'exists:leads,id'],
            'product_id' => ['required', 'exists:products,id'],
            'status'     => ['sometimes', 'required', Rule::in(array_keys(Project::STATUSES))],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'lead_id.required' => 'Calon pelanggan di perlukan',
            'lead_id.exists' => 'Calon pelanggan tidak sah',
            'product_id.required' => 'Produk di perlukan',
            'product_id.exists' => 'Produk tidak sah',
            'status.required' => 'Status di perlukan',
            'status.in' => 'Status tidak sah',
        ];
    }
}
