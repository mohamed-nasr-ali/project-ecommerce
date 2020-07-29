<?php

namespace App\Http\Requests\OrderRequests;

use App\Http\Requests\BaseFormRequest;

class OrderUpdateRequest extends BaseFormRequest
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
                'quantity' => 'required|numeric|gte:1'
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
            'quantity'  => 'trim|escape|digit',
        ];
    }
}
