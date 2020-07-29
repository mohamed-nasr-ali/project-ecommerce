<?php

namespace App\Http\Requests\OrderRequests;

use App\Http\Requests\BaseFormRequest;

class OrderStoreRequest extends BaseFormRequest
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

            return [
                'product_id' => 'required|numeric|exists:products,id',
                'quantity' => 'required|numeric|gte:1',
                'address' => 'required|string|max:255'
            ];


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
            'product_id'  => 'trim|escape|digit',
            'quantity'  => 'trim|escape|digit',
            'address'  => 'trim|escape|lowercase'
        ];
    }
}
