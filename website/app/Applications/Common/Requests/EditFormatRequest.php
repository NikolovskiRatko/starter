<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class EditFormatRequest extends ApiFormRequest
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
            'parts' => 'required',
            'gluing_coefficient' => 'required',
            'format_coefficient' => 'required'
        ];
    }
    public function messages(){
        return [
            'parts.required' => 'validation.parts.required',
            'gluing_coefficient.required' => 'validation.gluing_coefficient.required',
            'format_coefficient.required' => 'validation.format_coefficient.required',
        ];
    }
}
