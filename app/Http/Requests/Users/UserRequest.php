<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

use Facades\App\Services\Users\UserService;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $rules = [
            'title' => 'nullable|string|regex:/(^([a-zA-z\.\-]+)$)/u',
            'name' => 'required|string|alpha|min:2',
            'surname' => 'required|string|alpha|min:2',
            'birthdate' => 'required|date',
        ];

        $parameters = $this->route()->parameters;
        if(isset($parameters['user'])){

            $userObj = UserService::getOrFail($parameters['user']);

            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore($userObj->id),
            ];

        }else{

            $rules['email'] = 'required|email';

        }

        return $rules;
    }
}
