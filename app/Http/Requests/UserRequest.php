<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name'            => ['required','string','max:100'],
            'last_name'             => ['required','string','max:100'],
            'email'                 => ['required','email','unique:users,email'],
            'mobile'                => ['required','string','max:25'],
            'password'              => ['required','string','min:6','max:16','confirmed'],
            'password_confirmation' => ['required','string'],
            'image'                 => ['nullable','image','mimes:png,jpg','max:1024'],
        ];

        if(request()->update_id){
            $rules['email'][2]                 = 'unique:users,email,'.request()->update_id;
            $rules['password'][0]              = 'nullable';
            $rules['password_confirmation'][0] = 'nullable';
        }

        return $rules;
    }


}
