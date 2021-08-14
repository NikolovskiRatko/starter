<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'message' => 'The given data was invalid.',
    'fails' => 'Validation fails',

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'email'=>[
            'exists' => 'Fehler: Dieser Benutzer existiert nicht!',
            'required' => 'The email field is required.',
            'email'  => 'The email must be a valid email address.',
        ],
        'message'=>[
            'required' => 'Messages is required',
            'max' => 'Message can\'t be longer then 500 characters'
        ],
        'subject'=>[
            'required' => 'Subject is required',
            'max' => 'Subject can\'t be longer then 255 characters'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => 'e-mail',
        'password' => 'password',
        'type_id' => 'user type',
        'product.hf_cliche.1.height' => 'Hot foil stamping cliche height',
        'product.hf_cliche.2.height' => 'Hot foil stamping cliche height',
        'product.hf_cliche.3.height' => 'Hot foil stamping cliche height',
        'product.hf_cliche.1.width' => 'Hot foil stamping cliche width',
        'product.hf_cliche.2.width' => 'Hot foil stamping cliche width',
        'product.hf_cliche.3.width' => 'Hot foil stamping cliche width',

        'product.height' => 'Height',
        'product.width' => 'Width',
        'product.length' => 'Length',
        'product.handle_id' => 'Handle',
        'product.handle_color_id' => 'Handle color',
        'product.lamination_id' => 'Lamination',
        'product.paper_id' => 'Paper type',
        'product.bottom' => 'Bottom',
        'product.printed_bottom' => 'Printed bottom',
        'product.front_back' => 'Front/back',
        'product.spot_uv' => 'Spot UV varnish',

        'product.em_cliche.1.height' => 'Embossing cliche height',
        'product.em_cliche.2.height' => 'Embossing cliche height',
        'product.em_cliche.3.height' => 'Embossing cliche height',
        'product.em_cliche.1.width' => 'Embossing cliche width',
        'product.em_cliche.2.width' => 'Embossing cliche width',
        'product.em_cliche.3.width' => 'Embossing cliche width',

        'product.quantity' => 'Quantity',
        'product.max_package_weight' => 'Maximum package weight',
    ],

    'name' => [
        'required' => 'Name is required',
        'max' => 'Name can be a maximum of 255 characters',
        'min' => 'Name should be at least 2 characters',
    ],

    'address' => [
        'required' => 'Address is required',
        'max' => 'Address can be a maximum of 255 characters',
        'min' => 'Address should be at least 2 characters',
    ],

    'city' => [
        'required' => 'City is required',
        'max' => 'City can be a maximum of 255 characters',
        'min' => 'City should be at least 2 characters',
    ],

    'company' => [
        'required' => 'Company is required',
        'max' => 'Company can be a maximum of 255 characters',
        'min' => 'Company should be at least 2 characters',
    ],

    'company_vat' => [
        'required' => 'VAT is required',
        'max' => 'VAT can be a maximum of 255 characters',
        'min' => 'VAT should be at least 2 characters',
    ],

    'image_file' => [
        'required' => 'Must select an image',
        'max' => 'The file exceeds the 30MB limit',
        'file' => 'Must be of type file',
        'mimes' => 'Image has to be of the following formats: jpeg,jpg,png,gif',
    ],

    'phone' => 'Wrong phone format. Please use <+1 206 555 0100>"',
    'phone.required' => 'Phone is required',
    'country.required' => 'Country is required',
    'margin.required' => 'Margin is required',
    'weight.required' => 'Weight is required',
    'width.required' => 'Width is required',
    'height.required' => 'Height is required',
    'length.required' => 'Length is required',
    'value.required' => 'Value is required',
    'parts.required' => 'Parts is required',
    'display_name.required' => 'Display name is required',
    'type.required' => 'Type is required',
    'price.required' => 'Price is required',
    'hex_value.required' => 'Hex value is required',
    'gluing_coefficient.required' => 'Gluing Coefficient is required',
    'format_coefficient.required' => 'Format Coefficient is required',
];
