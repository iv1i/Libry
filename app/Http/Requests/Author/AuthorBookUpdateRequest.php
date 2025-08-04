<?php

namespace App\Http\Requests\Author;

use App\Enums\BookType;
use Illuminate\Foundation\Http\FormRequest;

class AuthorBookUpdateRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|nullable',
            'type' => 'sometimes|in:' . implode(',', BookType::values()),
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,name',
        ];
    }
}
