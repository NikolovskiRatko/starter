<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class EditColorRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // we will handle this with middleware
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
            'name' => 'required|max:255|min:2',
            'display_name' => 'required',
            'hex_value' => 'required',
            'type' => 'required',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'validation.name.required',
            'name.max' => 'validation.name.max',
            'name.min' => 'validation.name.min',
            'display_name.required' => 'validation.display_name.required',
            'hex_value.required' => 'validation.hex_value.required',
            'type.required' => 'validation.type.required',
        ];
    }
}
