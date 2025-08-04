<?php

namespace App\Http\Requests\Admin;

use App\Enums\BookType;
use Illuminate\Foundation\Http\FormRequest;

class AdminBookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:books',
            'description' => 'nullable|string',
            'author' => 'required|string|exists:authors,name',
            'type' => 'required|in:' . implode(',', BookType::values()),
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,name',
        ];
    }
}
