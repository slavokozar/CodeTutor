<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{
    /**
     * Determine if the profile is authorized to make this request.
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
            'name' => 'required|string|max:255',
            'group' => 'required|integer',
            'start' => 'required|date',
            'deadline' => 'required|date',
            'description' => 'required|string|max:255',
            'text' => 'required|string'
        ];
    }
}
