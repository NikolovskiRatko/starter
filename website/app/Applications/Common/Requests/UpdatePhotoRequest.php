<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class UpdatePhotoRequest extends ApiFormRequest
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
            'uploaded_file' => 'file|mimes:jpeg,jpg,png,gif|max:30000'
        ];
    }
    public function messages(){
        return [
            'uploaded_file.file' => 'locations.full_name.file',
            'uploaded_file.mimes' => 'strings.error.validation.uploaded_image',
            'uploaded_file.max' => 'locations.file.max',
        ];
    }
}
