<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
        $rules = [
            'full_name' => ['required','string','max:120'],
            'position'  => ['required','string','max:100'],
            'company'   => ['required','string','max:150'],
            'content'   => ['required','string'],
            'rating'    => ['required','between:1,5'],
            'is_social' => ['required','in:1,2'],
            'facebook'  => ['nullable','url'],
            'twitter'   => ['nullable','url'],
            'linkedin'  => ['nullable','url'],
            'youtube'   => ['nullable','url'],
            'status'    => ['required','in:1,2'],
            'image'     => ['nullable','image','mimes:png,jpg','max:512'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'role_id.required'=>'The role field is required.'
        ];
    }
}
