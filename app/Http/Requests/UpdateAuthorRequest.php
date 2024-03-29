<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
        if($this->method() == 'PUT')
        {
            return [
                'name' => ['required'],
                'last_name' => ['required'],
                'country_id' => ['required','numeric','exists:countries,id']
            ];
        } else {
            return [
                'name' => ['sometimes'],
                'last_name' => ['sometimes'],
                'country_id' => ['sometimes','numeric','exists:countries,id']
            ];
        }
    }
}
