<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  $this->user()->hasPermissionTo('create product');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:50|max:500',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:1',
            'tags' => 'nullable|string',
            'category' => 'nullable|array|exists:categories,id',//Verifies that the categories exists in the category table
        ];
    }
     
    // /**
    //  * Get the error messages for the defined validation rules.
    //  *
    //  * @return array
    //  */
    // public function messages()
    // {
    //     return [
    //         'title.required' => 'A title is required',
    //         'body.required'  => 'A message is required',
    //     ];
    // }
}
