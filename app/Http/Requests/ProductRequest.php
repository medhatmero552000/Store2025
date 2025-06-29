<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required|string|unique:product_translations,name,'.$this->id,
            'description'=>'nullable|string',
            'category_id'=>'required|string',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
       public function attributes()
    {
        return[
           //'title'=>__('keywords.title'),
        ];
    }
}
