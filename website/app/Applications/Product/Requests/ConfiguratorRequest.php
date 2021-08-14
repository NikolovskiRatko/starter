<?php

namespace App\Applications\Product\Requests;

use App\Http\Requests\ApiFormRequest;


class ConfiguratorRequest extends ApiFormRequest
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
            'product.height' => 'required|integer|between:1,100',
            'product.width' => 'required|integer|between:1,100',
            'product.length' => 'required|integer|between:1,100',
            'product.handle_id' => 'required|integer|between:1,9',
            'product.handle_color_id' => 'required',
            'product.lamination_id' => 'required|integer|between:1,5',
            'product.paper_id' => 'required|integer|between:1,12',
            'product.bottom' => 'required|integer|between:0,1',
            'product.printed_bottom' => 'required|integer|between:0,1',
            'product.front_back' => 'required|integer|between:0,1',
            'product.spot_uv' => 'required|integer|between:0,1',

            'product.hf_cliche.1.height' => 'required|integer|between:0,10',
            'product.hf_cliche.2.height' => 'required|integer|between:0,10',
            'product.hf_cliche.3.height' => 'required|integer|between:0,10',
            'product.hf_cliche.1.width' => 'required|integer|between:0,10',
            'product.hf_cliche.2.width' => 'required|integer|between:0,10',
            'product.hf_cliche.3.width' => 'required|integer|between:0,10',

            'product.em_cliche.1.height' => 'required|integer|between:0,10',
            'product.em_cliche.2.height' => 'required|integer|between:0,10',
            'product.em_cliche.3.height' => 'required|integer|between:0,10',
            'product.em_cliche.1.width' => 'required|integer|between:0,10',
            'product.em_cliche.2.width' => 'required|integer|between:0,10',
            'product.em_cliche.3.width' => 'required|integer|between:0,10',

            'product.quantity' => 'required|integer|numeric|min:1',
        ];

        return $rules;
    }
    public function messages(){
        return [
            'status.required' => 'status.required',
            'status.between:1,3' => 'status.between:0,3',
            'handle_color_id.required' => 'handle_color.required',
            'offer.name.required' => 'orders.offer.name.required',
            'offer.name.max' => 'orders.offer.name.max_len',
            'offer.name.min' => 'orders.offer.name.min_len',
        ];
    }
}
