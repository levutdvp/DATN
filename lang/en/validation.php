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

    'accepted' => 'The :Attribute field must be accepted.',
    'accepted_if' => 'The :Attribute field must be accepted when :other is :value.',
    'active_url' => 'The :Attribute field must be a valid URL.',
    'after' => 'The :Attribute field must be a date after :date.',
    'after_or_equal' => 'The :Attribute field must be a date after or equal to :date.',
    'alpha' => 'The :Attribute field must only contain letters.',
    'alpha_dash' => 'The :Attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'The :Attribute field must only contain letters and numbers.',
    'array' => 'The :Attribute field must be an array.',
    'ascii' => 'The :Attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :Attribute field must be a date before :date.',
    'before_or_equal' => 'The :Attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :Attribute field must have between :min and :max items.',
        'file' => 'The :Attribute field must be between :min and :max kilobytes.',
        'numeric' => 'The :Attribute field must be between :min and :max.',
        'string' => 'The :Attribute field must be between :min and :max characters.',
    ],
    'boolean' => 'The :Attribute field must be true or false.',
    'can' => 'The :Attribute field contains an unauthorized value.',
    'confirmed' => ':Attribute vui lòng nhập lại đúng.',
    'current_password' => 'The password is incorrect.',
    'date' => ':Attribute field must be a valid date.',
    'date_equals' => 'The :Attribute field must be a date equal to :date.',
    'date_format' => 'The :Attribute field must match the format :format.',
    'decimal' => 'The :Attribute field must have :decimal decimal places.',
    'declined' => 'The :Attribute field must be declined.',
    'declined_if' => 'The :Attribute field must be declined when :other is :value.',
    'different' => 'The :Attribute field and :other must be different.',
    'digits' => 'The :Attribute field must be :digits digits.',
    'digits_between' => 'The :Attribute field must be between :min and :max digits.',
    'dimensions' => 'The :Attribute field has invalid image dimensions.',
    'distinct' => 'The :Attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :Attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :Attribute field must not start with one of the following: :values.',
    'email' => ' :Attribute không đúng định dạng.',
    'ends_with' => 'The :Attribute field must end with one of the following: :values.',
    'enum' => 'The selected :Attribute is invalid.',
    'exists' => 'The selected :Attribute is invalid.',
    'file' => 'The :Attribute field must be a file.',
    'filled' => 'The :Attribute field must have a value.',
    'gt' => [
        'array' => 'The :Attribute field must have more than :value items.',
        'file' => 'The :Attribute field must be greater than :value kilobytes.',
        'numeric' => 'The :Attribute field must be greater than :value.',
        'string' => 'The :Attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :Attribute field must have :value items or more.',
        'file' => 'The :Attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :Attribute field must be greater than or equal to :value.',
        'string' => 'The :Attribute field must be greater than or equal to :value characters.',
    ],
    'image' => ':Attribute phải là ảnh.',
    'in' => 'The selected :Attribute is invalid.',
    'in_array' => 'The :Attribute field must exist in :other.',
    'integer' => 'The :Attribute field must be an integer.',
    'ip' => 'The :Attribute field must be a valid IP address.',
    'ipv4' => 'The :Attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :Attribute field must be a valid IPv6 address.',
    'json' => 'The :Attribute field must be a valid JSON string.',
    'lowercase' => 'The :Attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :Attribute field must have less than :value items.',
        'file' => 'The :Attribute field must be less than :value kilobytes.',
        'numeric' => 'The :Attribute field must be less than :value.',
        'string' => 'The :Attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :Attribute field must not have more than :value items.',
        'file' => 'The :Attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'The :Attribute field must be less than or equal to :value.',
        'string' => 'The :Attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :Attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'The :Attribute field must not have more than :max items.',
        'file' => 'The :Attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :Attribute field must not be greater than :max.',
        'string' => ':Attribute phải ít hơn :max kí tự.',
    ],
    'max_digits' => 'The :Attribute field must not have more than :max digits.',
    'mimes' => 'The :Attribute field must be a file of type: :values.',
    'mimetypes' => 'The :Attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'The :Attribute field must have at least :min items.',
        'file' => 'The :Attribute field must be at least :min kilobytes.',
        'numeric' => 'The :Attribute field mus:min.',
        'string' => ':Attribute ít nhất :min kí tự.',
    ],
    'min_digits' => 'The :Attribute field must have at least :min digits.',
    'missing' => 'The :Attribute field must be missing.',
    'missing_if' => 'The :Attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :Attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :Attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :Attribute field must be missing when :values are present.',
    'multiple_of' => 'The :Attribute field must be a multiple of :value.',
    'not_in' => 'The selected :Attribute is invalid.',
    'not_regex' => 'The :Attribute không hợp lệ.',
    'numeric' => 'The :Attribute field must be a number.',
    'password' => [
        'letters' => 'The :Attribute field must contain at least one letter.',
        'mixed' => 'The :Attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :Attribute field must contain at least one number.',
        'symbols' => 'The :Attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :Attribute has appeared in a data leak. Please choose a different :Attribute.',
    ],
    'present' => 'The :Attribute field must be present.',
    'prohibited' => 'The :Attribute field is prohibited.',
    'prohibited_if' => 'The :Attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :Attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :Attribute field prohibits :other from being present.',
    'regex' => 'The :Attribute không hợp lệ.',
    'required' => ':Attribute bắt buộc nhập.',
    'required_array_keys' => 'The :Attribute field must contain entries for: :values.',
    'required_if' => 'The :Attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :Attribute field is required when :other is accepted.',
    'required_unless' => 'The :Attribute field is required unless :other is in :values.',
    'required_with' => 'The :Attribute field is required when :values is present.',
    'required_with_all' => 'The :Attribute field is required when :values are present.',
    'required_without' => 'The :Attribute field is required when :values is not present.',
    'required_without_all' => 'The :Attribute field is required when none of :values are present.',
    'same' => 'The :Attribute field must match :other.',
    'size' => [
        'array' => 'The :Attribute field must contain :size items.',
        'file' => 'The :Attribute field must be :size kilobytes.',
        'numeric' => 'The :Attribute field must be :size.',
        'string' => 'The :Attribute field must be :size characters.',
    ],
    'starts_with' => 'The :Attribute field must start with one of the following: :values.',
    'string' => 'The :Attribute field must be a string.',
    'timezone' => 'The :Attribute field must be a valid timezone.',
    'unique' => ':Attribute đã tồn tại.',
    'uploaded' => 'The :Attribute không thể tải lên.',
    'uppercase' => 'The :Attribute field must be uppercase.',
    'url' => 'The :Attribute field must be a valid URL.',
    'ulid' => 'The :Attribute field must be a valid ULID.',
    'uuid' => 'The :Attribute field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for Attributes using the
    | convention "Attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given Attribute rule.
    |
    */

    'custom' => [
        'Attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our Attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'Attributes' => [],

];
