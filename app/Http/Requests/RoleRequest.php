<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'name'        => ['required','string','max:100','unique:roles,name'],
            'permission' => ['required','array']
        ];

        if(request()->update_id){
            $rules['name'][3] = 'unique:roles,name,'.request()->update_id;
        }

        return $rules;
    }

    public function messages(){
        return [
            'name.required' => 'The role name field is required',
        ];
    }
}
