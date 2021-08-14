<?php

namespace App\Applications\User\Requests;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class ShippingInfoRequest extends ApiFormRequest
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
            'address' => 'required|max:255|min:2',
//            'alt_address' => 'required|max:255|min:2',
            'city' => 'required|max:255|min:2',
            'country_id' => 'required',
            'company' => 'required|max:255|min:2',
//            'company_vat' => 'required|max:255|min:2',
            'phone' => 'required|phone:AUTO'
        ];
    }
    public function messages(){
        return [
        ];
    }
}
