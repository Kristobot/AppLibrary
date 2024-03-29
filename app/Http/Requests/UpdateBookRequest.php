<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
        if($this->method() === 'PUT')
        {
            return [
                //
                'author_id' => ['required','numeric','exists:authors,id'],
                'title' => ['required','string', 'unique:books,title'],
                'description' => ['required'],
                'published_year' => ['required'],
                'genres' => ['required','array'],
                'genres.*' => ['required','numeric','exists:genres,id']
            ];
        }else{
            return [
                //
                'author_id' => ['sometimes','numeric','exists:authors,id'],
                'title' => ['sometimes','string', 'unique:books,title'],
                'description' => ['sometimes'],
                'published_year' => ['sometimes'],
                'genres' => ['sometimes','array'],
                'genres.*' => ['sometimes','numeric','exists:genres,id']
            ];
        }
    }
}
