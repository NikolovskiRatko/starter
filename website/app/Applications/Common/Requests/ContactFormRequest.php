<?php

namespace App\Applications\Common\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class ContactFormRequest extends ApiFormRequest
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
            'email' => 'required|email',
            'message' => 'required|max:500',
            'subject' => 'required|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'validation.name.required',
            'name.max' => 'validation.name.max',
            'name.min' => 'validation.name.min',
            'email.required' => 'validation.custom.email.required',
            'email.email' => 'validation.custom.email.email',
            'message.required' => 'validation.custom.message.required',
            'message.max' => 'validation.custom.message.max',
            'subject.required' => 'validation.custom.subject.required',
            'subject.max' => 'validation.custom.subject.max',
        ];
    }
}
