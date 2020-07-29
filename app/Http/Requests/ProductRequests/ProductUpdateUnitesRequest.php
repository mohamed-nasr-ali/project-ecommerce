<?php

namespace App\Http\Requests\ProductRequests;

use App\Http\Requests\BaseFormRequest;

class ProductUpdateUnitesRequest extends BaseFormRequest
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
                'units' => 'required|numeric',
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
            'units' => 'escape|digit|trim'
        ];
    }
}
