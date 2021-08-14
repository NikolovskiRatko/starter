<?php

namespace App\Applications\User\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class NewUserRequest extends ApiFormRequest
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
        $role = $this->request->get('roles'); // Get the input value

        $rules = [
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'email' => 'required|email|min:2|max:255|unique:users,email,'.$this->segment(3),
            'phone' => 'required|phone:AUTO',
            'password' => 'sometimes|between:6,30|confirmed',
            'roles' => 'required|exists:roles,id',
            'country_id' => 'required',
            'uploaded_file' => 'required|file|mimes:jpeg,jpg,png,gif|max:30000',
        ];

        // Check condition to apply proper rules
        if ($role == 3) {
            $rules['shipping_details.name'] = 'required|max:255|min:2';
            $rules['shipping_details.address'] = 'required|max:255|min:2';
            $rules['shipping_details.city'] = 'required|max:255|min:2';
            $rules['shipping_details.phone'] = 'required|integer';
            $rules['shipping_details.country_id'] = 'required';

            $rules['billing_details.name'] = 'required|max:255|min:2';
            $rules['billing_details.address'] = 'required|max:255|min:2';
            $rules['billing_details.city'] = 'required|max:255|min:2';
            $rules['billing_details.phone'] = 'required|integer';
            $rules['billing_details.country_id'] = 'required';
        }

        return $rules;
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
            'password.required' => 'users.password.required',
            'password.between' => 'users.password.between',
            'password.confirmed' => 'users.password.confirmed',
            'uploaded_file.file' => 'users.file.required',
            'uploaded_file.max' => 'users.file.max',
            'uploaded_file.mimes' => 'strings.error.validation.uploaded_image',
            'country_id.required' => 'users.country.required',
        ];
    }
}
