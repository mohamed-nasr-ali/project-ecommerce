<?php

namespace App\Http\Requests\UserRequests;

use App\Http\Requests\BaseFormRequest;

class UserRegistrationRequest extends BaseFormRequest
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
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|string|email|max:255|min:3|unique:users,email',
                'password' => 'required|string',
                'c_password' => 'required|same:password',
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
            'email'  => 'trim|escape|lowercase',
            'name'  => 'trim|escape|lowercase'
        ];
    }
}
