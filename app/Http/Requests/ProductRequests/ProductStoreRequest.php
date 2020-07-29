<?php

namespace App\Http\Requests\ProductRequests;

use App\Http\Requests\BaseFormRequest;

class ProductStoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request('product_id')){

            return [
                'name' => 'required|string|min:3|max:255|unique:products,name,'.request('product_id'),
                'description' => 'required|string|max:255',
                'units' => 'required|numeric|gte:1',
                'price' => 'required|numeric|gte:1',
                'image' => 'string',
            ];
        }else{

            return [
                'name' => 'required|string|min:3|max:255|unique:products,name',
                'description' => 'required|string|max:255',
                'units' => 'required|numeric|gte:1',
                'price' => 'required|numeric|gte:1',
                'image' => 'string',
            ];
        }


    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
         ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => 'escape|lowercase|trim',
            'description' => 'escape|lowercase|trim',
            'units' => 'escape|digit|trim',
            'price' => 'escape|trim',
            'image' => 'escape|trim'
        ];
    }
}
