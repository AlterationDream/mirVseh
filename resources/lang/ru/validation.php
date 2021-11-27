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

    'accepted' => 'Вы должны принять :attribute.',
    'active_url' => 'Поле :attribute должно быть корректной ссылкой.',
    'after' => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal' => 'Поле :attribute должно быть датой после или равно :date.',
    'alpha' => 'Поле :attribute может содержать только буквы.',
    'alpha_dash' => 'Поле :attribute может содержать только буквы, цифры, дефисы и подчёркивания.',
    'alpha_num' => 'Поле :attribute может содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'before' => 'Поле :attribute должно быть датой до :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой до или равной :date.',
    'between' => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file' => 'Поле :attribute должно быть между :min и :max килобайт.',
        'string' => 'Поле :attribute должно быть между :min и :max символов.',
        'array' => 'Поле :attribute должно содержать от :min до :max элементов.',
    ],
    'boolean' => 'Поле :attribute должно быть 1 или 0.',
    'confirmed' => 'Подтверждение и :attribute должны совпадать.',
    'date' => 'Поле :attribute должно соответствовать формату даты.',
    'date_equals' => 'После :attribute должно быть датой :date.',
    'date_format' => 'Поле :attribute не совпадает с форматом :format.',
    'different' => 'Поле :attribute и :other должны различаться.',
    'digits' => 'Поле :attribute должно быть :digits цифрами.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions' => 'Поле :attribute не соответствует необходимому формату изображения.',
    'distinct' => 'Поле :attribute содержит дублирующиеся значения.',
    'email' => 'Поле :attribute должно содержать корректный email адрес.',
    'ends_with' => 'Поле :attribute должно заканчиваться одним из следующих значений: :values',
    'exists' => 'Поле :attribute не верно.',
    'file' => 'Поле :attribute должно содержать файл.',
    'filled' => 'Поле :attribute должно содержать значение.',
    'gt' => [
        'numeric' => 'Поле :attribute должно быть больше, чем :value.',
        'file' => 'Поле :attribute должно быть больше, чем :value килобайтов.',
        'string' => 'Поле :attribute должно содержать больше, чем :value символов.',
        'array' => 'Поле :attribute должно содержать больше, чем :value символов.',
    ],
    'gte' => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file' => 'Поле :attribute должно быть больше или равно :value килобайтов.',
        'string' => 'Поле :attribute должно содержать больше или ровно :value символов.',
        'array' => 'Поле :attribute должно содержать :value элементов или более.',
    ],
    'image' => 'Поле :attribute должно содержать изображение.',
    'in' => 'Выбранное поле :attribute не верно.',
    'in_array' => 'Поле :attribute не содержится в :other.',
    'integer' => 'Поле :attribute должно содержать целое число.',
    'ip' => 'Поле :attribute должно содеждать корректный IP адрес.',
    'ipv4' => 'Поле :attribute должно содержать корректный IPv4 адрес.',
    'ipv6' => 'Поле :attribute должно содержать корректный IPv6 адрес.',
    'json' => 'Поле :attribute должно содержать корректную JSON строку.',
    'lt' => [
        'numeric' => 'Поле :attribute должно быть меньше, чем :value.',
        'file' => 'Поле :attribute должно быть меньше, чем :value килобайтов.',
        'string' => 'Поле :attribute должно быть меньше, чем :value символов.',
        'array' => 'Поле :attribute должно содержать менее :value элементов.',
    ],
    'lte' => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file' => 'Поле :attribute должно быть меньше или равно :value KB.',
        'string' => 'Поле :attribute должно содержать менее :value символов.',
        'array' => 'Поле :attribute не должно содержать более :value элементов.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute должно быть не более, чем :max.',
        'file' => 'Поле :attribute не может больше :max KB.',
        'string' => 'Поле :attribute не может быть больше :max символов.',
        'array' => 'Поле :attribute не может содержать больше :max элементов.',
    ],
    'mimes' => 'Поле :attribute должно быть файлом типа: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом типа: :values.',
    'min' => [
        'numeric' => 'Поле :attribute должно быть не меньше :min.',
        'file' => 'Поле :attribute должно быть не меньше :min KB.',
        'string' => 'Поле :attribute должно содержать не меншье :min символов.',
        'array' => 'Поле :attribute должно содержать не меньше :min элементов.',
    ],
    'not_in' => 'Выбранные значения :attribute не верны.',
    'not_regex' => 'Формат поля :attribute не соблюдён.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => 'Пароль введён не верно.',
    'present' => 'Поле :attribute должно присутствовать.',
    'regex' => 'Формат поля :attribute не соблюдён.',
    'required' => 'Поле :attribute - необходимое.',
    'required_if' => 'Поле :attribute необходимо, когда :other - :value.',
    'required_unless' => 'Поле :attribute необходимо, только если :other не :values.',
    'required_with' => 'Поле :attribute необходимо, когда :values присутствуют.',
    'required_with_all' => 'Поле :attribute необходимо, когда :values присутствуют.',
    'required_without' => 'Поле :attribute необходимо, когда :values не присутствуют.',
    'required_without_all' => 'Поле :attribute необходимо, когда ни одно из значений :values не присутствует.',
    'same' => 'Поле :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => 'Поле :attribute должно быть следующего размера: :size.',
        'file' => 'Поле :attribute должно быть размером :size KB.',
        'string' => 'Поле :attribute должно быть длинной :size символов.',
        'array' => 'Поле :attribute должно содержать :size элементов.',
    ],
    'starts_with' => 'Поле :attribute должно начинваться с одного из следующих значений: :values',
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть корректноый временным поясом.',
    'unique' => 'Поле :attribute уже занято.',
    'uploaded' => 'Поле :attribute не удалось загрузить.',
    'url' => 'Формат поля :attribute не соблюдён.',
    'uuid' => 'Поле :attribute должно содержать корректный UUID.',

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
        'g-recaptcha-response' => [
            'required' => 'Please verify that you are not a robot.',
            'captcha' => 'Captcha error! try again later or contact site admin.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'fullname' => 'Полное имя',
        'address' => 'Адрес',
        'country' => 'Страна',
        'birthday' => 'День рождения',
        'phone' => 'Телефон',
        'title' => 'Название',
        'folder' => 'Папка',
        'users' => "Участники",
        'pinned' => 'Закрепить',
        'private' => 'Приватный',
        'tetatet' => 'Частный',
        'password' => 'Пароль',
        'password_confirmation' => 'Подтверждение пароля',
        'login' => 'Логин',
        'username' => 'Логин',
        'name' => 'Название'
    ],

];
