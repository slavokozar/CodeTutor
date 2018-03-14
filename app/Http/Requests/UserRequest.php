<?php

namespace App\Http\Requests;

use Facades\App\Services\Users\UserService;
use Illuminate\Foundation\Http\FormRequest;
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
        $userObj = UserService::getOrFail($this->route()->parameters['user']);

        return [
            'name' => 'required|string|min:5',
            'email' => [
                'required',
                Rule::unique('users')->ignore($userObj->id),
            ],
            'birthdate' => 'required|date',
        ];
    }
}
