<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class EditCombinationRequest extends ApiFormRequest
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
            'width' => 'required',
            'height' => 'required',
            'length' => 'required',
            'image' => 'file|mimes:jpeg,jpg,png,gif|max:30000',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'validation.name.required',
            'name.max' => 'validation.name.max',
            'name.min' => 'validation.name.min',
            'width.required' => 'validation.width.required',
            'height.required' => 'validation.height.required',
            'length.required' => 'validation.length.required',
            'image.file' => 'validation.image_file.file',
            'image.max' => 'validation.image_file.max',
            'image.mimes' => 'validation.image_file.mimes',
        ];
    }
}
