<?php

namespace App\Applications\Order\Requests;

use App\Http\Requests\ApiFormRequest;


class OrderRequest extends ApiFormRequest
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
        $rules = [
            'status' => 'required|integer|between:0,3',
            'shipping_detail_id' => 'required',

            'shipping_details.name' => 'required|max:255|min:2',
            'shipping_details.address' => 'required|max:255|min:2',
            'shipping_details.city' => 'required|max:255|min:2',
            'shipping_details.phone' => 'required|phone:AUTO',

            'billing_details.name' => 'required|max:255|min:2',
            'billing_details.address' => 'required|max:255|min:2',
            'billing_details.city' => 'required|max:255|min:2',
            'billing_details.phone' => 'required|phone:AUTO',

            'offer.days_to_delivery' => 'required|integer|between:15,35',
            //'offer.name' => 'required|max:255|min:2',

            'offer.product.height' => 'required|integer|between:1,100',
            'offer.product.width' => 'required|integer|between:1,100',
            'offer.product.length' => 'required|integer|between:1,100',
            'offer.product.handle_id' => 'required|integer|between:1,9',
            'offer.product.lamination_id' => 'required|integer|between:1,4',
            'offer.product.paper_id' => 'required|integer|between:1,12',
            'offer.product.bottom' => 'required|integer|between:0,1',
            'offer.product.printed_bottom' => 'required|integer|between:0,1',
            'offer.product.front_back' => 'required|integer|between:0,1',
            'offer.product.spot_uv' => 'required|integer|between:0,1',

            'offer.product.hot_foil_cliches.0.height' => 'required|integer|between:0,10',
            'offer.product.hot_foil_cliches.1.height' => 'required|integer|between:0,10',
            'offer.product.hot_foil_cliches.2.height' => 'required|integer|between:0,10',
            'offer.product.hot_foil_cliches.0.width' => 'required|integer|between:0,10',
            'offer.product.hot_foil_cliches.1.width' => 'required|integer|between:0,10',
            'offer.product.hot_foil_cliches.2.width' => 'required|integer|between:0,10',

            'offer.product.embossing_cliches.0.height' => 'required|integer|between:0,10',
            'offer.product.embossing_cliches.1.height' => 'required|integer|between:0,10',
            'offer.product.embossing_cliches.2.height' => 'required|integer|between:0,10',
            'offer.product.embossing_cliches.0.width' => 'required|integer|between:0,10',
            'offer.product.embossing_cliches.1.width' => 'required|integer|between:0,10',
            'offer.product.embossing_cliches.2.width' => 'required|integer|between:0,10',

            'offer.product.quantity' => 'required|integer|numeric|min:0',
        ];

        return $rules;
    }
    public function messages(){
        return [
            'status.required' => 'status.required',
            'status.between:1,3' => 'status.between:0,3',
            //'offer.name.required' => 'orders.offer.name.required',
            //'offer.name.max' => 'orders.offer.name.max_len',
            //'offer.name.min' => 'orders.offer.name.min_len',
        ];
    }
}
