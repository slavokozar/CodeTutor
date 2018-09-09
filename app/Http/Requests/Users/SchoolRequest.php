<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17.3.18
 * Time: 22:55
 */

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'address' => 'nullable|string',
            'url' => 'nullable|string|max:255',
        ];

        return $rules;
    }
}