<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
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
            'per_page' => 'integer|min:1',
            'page' => 'integer|min:1',
            'sort_by' => 'string|in:id,name,start_datetime,created_at,updated_at',
            'sort_order' => 'string|in:asc,desc',
            'search' => 'string|nullable|max:255',
        ];
    }
}
