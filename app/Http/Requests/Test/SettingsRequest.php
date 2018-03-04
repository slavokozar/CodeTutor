<?php

namespace App\Http\Requests\Test;

use App\Models\Assignment;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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

        $rules = [];


        foreach(Assignment::where('code', $this->assignment)->first()->programmingLanguages as $programmingLanguage){
            $rules['timeout_' . $programmingLanguage->code] = 'integer';
            $rules['options_basic_' . $programmingLanguage->code . '.*'] = 'string';
            $rules['options_extended_' . $programmingLanguage->code . '.*'] = 'string';
        }

        return $rules;
    }
}
