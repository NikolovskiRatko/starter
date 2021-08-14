<?php

namespace App\Applications\Order\Requests;

use App\Http\Requests\ApiFormRequest;


class CheckoutRequest extends ApiFormRequest
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
        $default_shipping_address = $this->request->get('default_shipping_address');
        $use_default_shipping_address = in_array(0, $default_shipping_address);

        $default_billing_address = $this->request->get('default_billing_address');
        $use_default_billing_address = in_array(0, $default_billing_address);
        $rules = [];
        if(!$use_default_shipping_address)
        {
            $rules = array_merge($rules, [
                'shipping_address.name' => 'required|max:255|min:2',
                'shipping_address.address' => 'required|max:255|min:2',
                'shipping_address.city' => 'required|max:255|min:2',
                'shipping_address.phone' => 'required|phone:AUTO',
                'shipping_address.country_id' => 'required',
                'shipping_address.company' => 'required|max:255|min:2',
                'shipping_address.company_vat' => 'required|max:255|min:2'
                ]);
        }

        if(!$use_default_billing_address)
        {
            $rules = array_merge($rules, [
                'billing_address.name' => 'required|max:255|min:2',
                'billing_address.address' => 'required|max:255|min:2',
                'billing_address.city' => 'required|max:255|min:2',
                'billing_address.phone' => 'required|phone:AUTO',
                'billing_address.country_id' => 'required',
                'billing_address.company' => 'required|max:255|min:2',
                'billing_address.company_vat' => 'required|max:255|min:2'
            ]);
        }

        $rules = array_merge($rules, [
            'offer_id' => 'required',
            'product_id' => 'required',
//            'company' => 'required',
//            'company_vat' => 'required',
        ]);

        return $rules;
    }
    public function messages(){
        return [
            'shipping_address.name.required' => 'validation.name.required',
            'shipping_address.name.max' => 'validation.name.max',
            'shipping_address.name.min' => 'validation.name.min',
            'shipping_address.address.required' => 'validation.address.required',
            'shipping_address.address.max' => 'validation.address.max',
            'shipping_address.address.min' => 'validation.address.min',
            'shipping_address.city.required' => 'validation.city.required',
            'shipping_address.city.max' => 'validation.city.max',
            'shipping_address.city.min' => 'validation.city.min',
            'shipping_address.phone.required' => 'validation.phone.required',
            'shipping_address.country_id.required' => 'validation.country.required',
            'shipping_address.company.required' => 'validation.company.required',
            'shipping_address.company.max' => 'validation.company.max',
            'shipping_address.company.min' => 'validation.company.min',
            'shipping_address.company_vat.required' => 'validation.company_vat.required',
            'shipping_address.company_vat.max' => 'validation.company_vat.max',
            'shipping_address.company_vat.min' => 'validation.company_vat.min',
            'billing_address.name.required' => 'validation.name.required',
            'billing_address.name.max' => 'validation.name.max',
            'billing_address.name.min' => 'validation.name.min',
            'billing_address.address.required' => 'validation.address.required',
            'billing_address.address.max' => 'validation.address.max',
            'billing_address.address.min' => 'validation.address.min',
            'billing_address.city.required' => 'validation.city.required',
            'billing_address.city.max' => 'validation.city.max',
            'billing_address.city.min' => 'validation.city.min',
            'billing_address.phone.required' => 'validation.phone.required',
            'billing_address.country_id.required' => 'validation.country.required',
            'billing_address.company.required' => 'validation.company.required',
            'billing_address.company.max' => 'validation.company.max',
            'billing_address.company.min' => 'validation.company.min',
            'billing_address.company_vat.required' => 'validation.company_vat.required',
            'billing_address.company_vat.max' => 'validation.company_vat.max',
            'billing_address.company_vat.min' => 'validation.company_vat.min'
        ];
    }
}
