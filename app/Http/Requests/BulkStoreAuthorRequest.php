<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreAuthorRequest extends FormRequest
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
            //
            '*.name' => ['required'],
            '*.last_name' => ['required'],
            '*.country_id' => ['required','numeric','exists:countries,id']
        ];
    }

    public function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['created_at'] = now();
            $obj['updated_at'] = now();
            $data[] = $obj; 
        }

        $this->merge($data);
    }
}
