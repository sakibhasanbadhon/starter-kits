<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'            => ['required','string','max:180'],
            'excerpt'          => ['required','string','max:250'],
            'body'             => ['required','string'],
            'category_id'      => ['required','integer'],
            'is_featured'      => ['required','in:1,2'],
            'status'           => ['required','in:1,2'],
            'feature_image'    => ['required','image','mimes:png,jpg','max:1024'],
            'meta_title'       => ['nullable','string','max:70'],
            'meta_description' => ['nullable','string','max:170'],

        ];

        if(request()->update_id){
            $rules['feature_image'][0] = 'nullable';
        }

        return $rules;
    }

    public function messages(){
        return [
            'category_id.required' => 'The category field is required',
            'body.required' => 'The content field is required',
        ];
    }
}
