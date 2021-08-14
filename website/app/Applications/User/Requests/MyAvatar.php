<?php

namespace App\Applications\User\Requests;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Support\Facades\Auth;


class MyAvatar extends ApiFormRequest
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
            'uploaded_file' => 'file|mimes:jpeg,jpg,png,gif|max:30000',
        ];
    }
    public function messages(){
        return [
            'uploaded_file.file' => 'users.file.required',
            'uploaded_file.max' => 'users.file.max',
            'uploaded_file.mimes' => 'strings.error.validation.uploaded_image',
        ];
    }
}
