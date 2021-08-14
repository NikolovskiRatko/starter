<?php

namespace App\Applications\Homepage\Requests;

use App\Http\Requests\ApiFormRequest;


class SlideRequest extends ApiFormRequest
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
            'title' => 'required|max:255|min:2',
            'subtitle' => 'required|max:255|min:2',
            'description' => 'required|max:255|min:2',
        ];
    }
    public function messages(){
        return [
            'title.required' => 'sliders.title.required',
            'title.min' => 'sliders.title.min',
            'title.max' => 'sliders.title.max',
            'subtitle.required' => 'sliders.subtitle.required',
            'subtitle.min' => 'users.username.min',
            'subtitle.max' => 'users.username.max',
            'description.required' => 'users.username.required',
            'description.min' => 'users.username.min',
            'description.max' => 'users.username.max',
        ];
    }
}
