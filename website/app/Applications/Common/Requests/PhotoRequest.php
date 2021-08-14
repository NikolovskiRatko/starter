<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class PhotoRequest extends ApiFormRequest
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

        /*$rules = [];
        print_r($this->get('uploaded_file'));
        die;
        $photos = count($this->input('uploaded_file'));
        foreach(range(0, $photos) as $index) {
            $rules['uploaded_file.' . $index] = 'required|file|max:30000';
        }*/

        return [
            'uploaded_file' => 'required',
            'uploaded_file.*' => 'file|mimes:jpeg,jpg,png,gif|max:30000'
        ];
    }
    public function messages(){
        return [
             'uploaded_file.required' => 'validations.file.required',
             'uploaded_file.file' => 'validations.file.required',
             'uploaded_file.max' => 'validations.file.max',
             'uploaded_file.mimes' => 'strings.error.validation.uploaded_image',
        ];
    }
}
