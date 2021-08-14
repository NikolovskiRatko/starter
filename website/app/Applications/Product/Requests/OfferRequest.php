<?php

namespace App\Applications\Product\Requests;

use App\Http\Requests\ApiFormRequest;


class OfferRequest extends ApiFormRequest
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
            'days_to_delivery' => 'numeric|min:15',
        ];
    }
    public function messages(){
        return [
            'days_to_delivery.required' => 'offer.required',
        ];
    }
}
