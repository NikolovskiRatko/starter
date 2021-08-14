<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class NewPaperRequest extends ApiFormRequest
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
            'weight' => 'required',
            'type' => 'required',
            'price' => 'required',
            'margin' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'validation.name.required',
            'display_name.required' => 'validation.display_name.required',
            'weight.required' => 'validation.weight.required',
            'type.required' => 'validation.type.required',
            'price.required' => 'validation.price.required',
            'margin.required' => 'validation.margin.required',
            'name.max' => 'validation.name.max',
            'name.min' => 'validation.name.min',
        ];
    }
}
