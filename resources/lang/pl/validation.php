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

    'accepted'             => 'Pole :attribute must be accepted.',
    'active_url'           => 'Pole :attribute is not a valid URL.',
    'after'                => 'Pole :attribute must be a date after :date.',
    'alpha'                => 'Pole :attribute może zawierać tylko litery.',
    'alpha_dash'           => 'Pole :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Pole :attribute may only contain letters and numbers.',
    'array'                => 'Pole :attribute musi być tablicą.',
    'before'               => 'Pole :attribute musi być datą przed :date.',
    'between'              => [
        'numeric' => 'Pole :attribute musi być pomiędzy :min i :max.',
        'file'    => 'Plik :attribute musi mieć rozmiar pomiędzy :min i :max kB.',
        'string'  => 'Pole :attribute musi zawierać pomiędzy :min i :max znaków.',
        'array'   => 'Pole :attribute musi zawierać pomiędzy :min i :max elementów.',
    ],
    'boolean'              => 'Pole :attribute musi być typu prawda lub fałsz.',
    'confirmed'            => 'Pole :attribute nie jest potwierdzone.',
    'date'                 => 'Pole :attribute nie jest poprawną datą.',
    'date_format'          => 'Pole :attribute nie jest formatu :format.',
    'different'            => 'Pola :attribute i :other muszą być różne.',
    'digits'               => 'Pole :attribute musi składać się z :digits liczb.',
    'digits_between'       => 'Pole :attribute musi zawierać pomiędzy :min a :max liczb.',
    'email'                => 'Pole :attribute musi być poprawnym adresem E-mail.',
    'exists'               => 'Wybrany :attribute jest niepoprawny.',
    'filled'               => 'Pole :attribute musi być wypełnione.',
    'image'                => 'Pole :attribute musi być obrazkiem.',
    'in'                   => 'Pole selected :attribute is invalid.',
    'integer'              => 'Pole :attribute musi być liczbą.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Pole :attribute nie może być większy niż :max.',
        'file'    => 'Plik :attribute nie może być większy niż :max kB.',
        'string'  => 'Pole :attribute nie może zawierać więcej niż :max znaków.',
        'array'   => 'Pole :attribute nie może zawierać więcej niż :max elementów.',
    ],
    'mimes'                => 'Pole :attribute musi być typu: :values.',
    'min'                  => [
        'numeric' => ' :attribute musi być większy niż :min.',
        'file'    => ' :attribute musi być większy niż :min kB.',
        'string'  => ' :attribute musi zawierać więcej niż :min characters.',
        'array'   => ' :attribute musi zawierać więcej niż :min elementów.',
    ],
    'not_in'               => 'Wybrany :attribute jest niepoprawny.',
    'numeric'              => 'Pole :attribute musi być liczbą.',
    'regex'                => ' :attribute format jest niepoprawny.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagany jeżeli :or jest :value.',
    'required_unless'      => ' :attribute field is required unless :or is in :values.',
    'required_with'        => ' :attribute field is required when :values is present.',
    'required_with_all'    => ' :attribute field is required when :values is present.',
    'required_without'     => ' :attribute field is required when :values is not present.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same'                 => 'Pola :attribute i :other muszą być identyczne.',
    'size'                 => [
        'numeric' => 'Pole :attribute musi mieć dokładnie :size.',
        'file'    => 'Pole :attribute must be :size kilobytes.',
        'string'  => 'Pole :attribute must be :size characters.',
        'array'   => 'Pole :attribute must contain :size items.',
    ],
    'string'               => 'Pole :attribute musi być tekstem.',
    'timezone'             => 'Pole :attribute must be a valid zone.',
    'unique'               => 'Pole :attribute musi być unikalne.',
    'url'                  => 'Pole :attribute nie jest poprawny adresem url.',

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

    'attributes' => [],

];
