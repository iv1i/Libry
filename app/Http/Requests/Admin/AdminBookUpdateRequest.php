<?php

namespace App\Http\Requests\Admin;

use App\Enums\BookType;
use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminBookUpdateRequest extends FormRequest
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
    public function rules(Book $book): array
    {
        return [
            'title' => 'sometimes|string|max:255|unique:books,title,'.Rule::unique('authors')->ignore($book->id),
            'description' => 'sometimes|string|nullable',
            'author' => 'sometimes|string|exists:authors,name',
            'type' => 'sometimes|in:' . implode(',', BookType::values()),
            'genres' => 'sometimes|array',
            'genres.*' => 'exists:genres,name',
        ];
    }
}
