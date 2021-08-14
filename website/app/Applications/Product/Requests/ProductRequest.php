<?php

namespace App\Applications\Product\Requests;

use App\Http\Requests\ApiFormRequest;


class ProductRequest extends ApiFormRequest
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

            'product.height' => 'required|integer|between:1,100',
            'product.width' => 'required|integer|between:1,100',
            'product.length' => 'required|integer|between:1,100',
            'product.handle_id' => 'required|integer|between:1,9',
            'product.lamination_id' => 'required|integer|between:1,4',
            'product.paper_id' => 'required|integer|between:1,12',
            'product.bottom' => 'required|integer|between:0,1',
            'product.printed_bottom' => 'required|integer|between:0,1',
            'product.front_back' => 'required|integer|between:0,1',
            'product.spot_uv' => 'required|integer|between:0,1',

            'product.hot_foil_cliches.0.height' => 'required|integer|between:0,10',
            'product.hot_foil_cliches.1.height' => 'required|integer|between:0,10',
            'product.hot_foil_cliches.2.height' => 'required|integer|between:0,10',
            'product.hot_foil_cliches.0.width' => 'required|integer|between:0,10',
            'product.hot_foil_cliches.1.width' => 'required|integer|between:0,10',
            'product.hot_foil_cliches.2.width' => 'required|integer|between:0,10',

            'product.embossing_cliches.0.height' => 'required|integer|between:0,10',
            'product.embossing_cliches.1.height' => 'required|integer|between:0,10',
            'product.embossing_cliches.2.height' => 'required|integer|between:0,10',
            'product.embossing_cliches.0.width' => 'required|integer|between:0,10',
            'product.embossing_cliches.1.width' => 'required|integer|between:0,10',
            'product.embossing_cliches.2.width' => 'required|integer|between:0,10',

            'product.quantity' => 'required|integer|numeric|min:0',
            'product.max_package_weight' => 'required|in:15,18,25',
        ];
    }
    public function messages(){
        return [
        ];
    }
}
