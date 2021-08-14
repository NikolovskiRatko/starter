<?php

namespace App\Applications\User\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class MyProfile extends ApiFormRequest
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
//            'username' => 'sometimes|required|max:255|min:2',
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'email' => 'required|email|min:2|max:255|unique:users,email,'.Auth::user()->id,
            'password' => 'required_with:password_confirmation|nullable|between:6,30|confirmed',
            'password_confirmation' => 'required_with:password|nullable|between:6,30|same:password',
            'uploaded_file' => 'file|mimes:jpeg,jpg,png,gif|max:30000',
        ];
    }
    public function messages(){
        return [
            'username.required' => 'users.username.required',
            'username.max' => 'users.username.max',
            'username.min' => 'users.username.min',
            'first_name.required' => 'users.first_name.required',
            'first_name.max' => 'users.first_name.max',
            'first_name.min' => 'users.first_name.min',
            'last_name.required' => 'users.last_name.required',
            'last_name.max' => 'users.last_name.max',
            'last_name.min' => 'users.last_name.min',
            'email.required' => 'users.email.required',
            'email.email' => 'users.email.invalid',
            'email.max' => 'users.email.max',
            'email.min' => 'users.email.min',
            'email.unique' => 'users.email.unique',
            'roles.required' => 'users.roles.required',
            'roles.exists' => 'users.roles.exists',
            'password.required_with' => 'users.password.required',
            'password_confirmation.required_with' => 'users.password_confirmation.required',
            'password.between' => 'users.password.between',
            'password.confirmed' => 'users.password.confirmed',
            'uploaded_file.file' => 'users.file.required',
            'uploaded_file.max' => 'users.file.max',
            'uploaded_file.mimes' => 'strings.error.validation.uploaded_image',
            'country_id.required' => 'users.country.required',
        ];
    }
}
