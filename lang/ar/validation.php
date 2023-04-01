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

    'accepted' => 'يجب قبول :attribute',
    'active_url' => 'عنوان رابط السمه ليس صحيحا',
    'after' => '.يجب أن تكون :attribute تاريخًا بعد تاريخ',
    'after_or_equal' => 'يجب أن تكون :attribute تاريخًا بعد التاريخ أو مساويًا له',
    'alpha' => 'قد تحتوي :attribute على أحرف فقط',
    'alpha_dash' => 'لا يجوز أن تحتوي :attribute إلا على أحرف وأرقام وشرطات وشرطات سفلية',
    'alpha_num' => 'قد تحتوي :attribute على أحرف وأرقام فقط',
    'array' => 'يجب أن تكون :attribute مصفوفة',
    'before' => 'يجب أن تكون :attribute تاريخًا قبل التاريخ',
    'before_or_equal' => 'يجب أن تكون :attribute تاريخًا قبل التاريخ أو مساويًا له',
    'between' => [
        'numeric' => 'يجب أن تكون :attribute بين min و max',
        'file' => 'يجب أن تتراوح :attribute بين min و max كيلوبايت',
        'string' => 'يجب أن تكون :attribute بين الحد الأدنى والحد الأقصى للأحرف',
        'array' => 'يجب أن تحتوي :attribute على ما بين الحد الأدنى والحد الأقصى للعناصر',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute صحيحًا أو خطأ',
    'confirmed' => 'تأكيد :attribute غير متطابق',
    'date' => ':attribute ليست تاريخًا صالحً',
    'date_equals' => 'يجب أن تكون :attribute تاريخًا مساويًا للتاريخ',
    'date_format' => ':attribute لا تتطابق مع تنسيق التنسيق',
    'different' => 'يجب أن تكون :attribute والأخرى مختلفة',
    'digits' => 'يجب أن تتكون :attribute من أرقام',
    'digits_between' => 'يجب أن تكون :attribute بين الحد الأدنى والحد الأقصى للأرقام',
    'dimensions' => ':attribute لها أبعاد صورة غير صالحة',
    'distinct' => 'حقل :attribute له قيمة مكررة',
    'email' => 'يجب أن تكون :attribute عنوان بريد إلكتروني صالحًا',
    'ends_with' => 'يجب أن تنتهي :attribute بإحدى القيم التالية',
    'exists' => ':attribute المحددة: غير صالحة',
    'file' => 'يجب أن تكون :attribute ملفًا',
    'filled' => 'يجب أن يحتوي حقل :attribute على قيمة',
    'gt' => [
        'numeric' => 'يجب أن تكون :attribute أكبر من القيمة',
        'file' => 'يجب أن تكون :attribute أكبر من قيمة كيلوبايت',
        'string' => 'يجب أن تكون :attribute أكبر قيمة',
        'array' => 'يجب أن تحتوي :attribute على أكثر من: عناصر القيمة',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون :attribute أكبر من أو تساوي: القيمة',
        'file' => 'يجب أن تكون :attribute أكبر من أو تساوي: القيمة كيلوبايت',
        'string' => 'يجب أن تكون :attribute أكبر من أو تساوي: أحرف القيمة',
        'array' => 'يجب أن تحتوي :attribute على عناصر قيمة أو أكثر',
    ],
    'image' => 'يجب أن تكون :attribute صورة',
    'in' => ':attribute المحددة: غير صالحة',
    'in_array' => 'حقل :attribute غير موجود في: أخرى',
    'integer' => 'يجب أن تكون :attribute عددًا صحيحًا',
    'ip' => 'يجب أن تكون :attribute عنوان IP صالحًا',
    'ipv4' => 'يجب أن تكون :attribute عنوان IPv4 صالحًا',
    'ipv6' => 'يجب أن تكون :attribute عنوان IPv6 صالحًا',
    'json' => 'يجب أن تكون :attribute سلسلة JSON صالحة',
    'lt' => [
        'numeric' => 'يجب أن تكون :attribute أقل من: القيمة',
        'file' => 'يجب أن تكون :attribute أقل من: value كيلوبايت',
        'string' => 'يجب أن تكون :attribute أقل من: أحرف القيمة',
        'array' => 'يجب أن تحتوي :attribute على أقل من: عناصر القيمة',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون :attribute أقل من أو تساوي: القيمة',
        'file' => 'يجب أن تكون :attribute أقل من أو تساوي: value كيلوبايت',
        'string' => 'يجب أن تكون :attribute أقل من أو تساوي: أحرف القيمة',
        'array' => 'يجب ألا تحتوي :attribute على أكثر من: عناصر القيمة',
    ],
    'max' => [
        'numeric' => 'لا يجوز أن تكون :attribute أكبر من',
        'file' => 'لا يجوز أن تكون :attribute أكبر من: max كيلوبايت',
        'string' => 'لا يجوز أن تكون :attribute أكبر من: الحد الأقصى من الأحرف',
        'array' => 'لا يجوز أن تحتوي :attribute على أكثر من',
    ],
    'mimes' => 'يجب أن تكون :attribute ملفًا من النوع: القيم',
    'mimetypes' => 'يجب أن تكون :attribute ملفًا من النوع: القيم',
    'min' => [
        'numeric' => 'يجب أن تكون :attribute على الأقل دقيقة.',
        'file' => 'يجب أن تكون :attribute على الأقل: دقيقة كيلوبايت',
        'string' => 'يجب ألا تقل :attribute عن: min حرفًا',
        'array' => 'يجب أن تحتوي :attribute على الأقل على: min من العناصر',
    ],
    'not_in' => ':attribute المحددة: غير صالحة',
    'not_regex' => 'تنسيق :attribute غير صالح',
    'numeric' => 'يجب أن تكون :attribute رقمًا',
    'present' => 'يجب أن يكون حقل :attribute موجودًا',
    'regex' => 'تنسيق :attribute غير صالح',
    'required' => ': حقل :attribute مطلوب',
    'required_if' => ':attribute مطلوبًا',
    'required_unless' => 'حقل :attribute مطلوب إلا إذا كان الآخر في: قيم',
    'required_with' => 'يكون حقل :attribute مطلوبًا عندما تكون: القيم موجودة',
    'required_with_all' => 'يكون حقل :attribute مطلوبًا عندما تكون: القيم موجودة',
    'required_without' => 'يكون حقل :attribute مطلوبًا عندما: القيم غير موجودة',
    'required_without_all' => 'يكون حقل :attribute مطلوبًا في حالة عدم وجود أي من قيم',
    'same' => 'يجب أن يتطابق :attribute و: الآخر',
    'size' => [
        'numeric' => 'يجب أن تكون :attribute المقاس',
        'file' => 'يجب أن تكون :attribute المقاس كيلوبايت',
        'string' => 'يجب أن تكون :attribute حجم الأحرف',
        'array' => 'يجب أن تحتوي :attribute على عناصر المقاس',
    ],
    'starts_with' => 'يجب أن تبدأ :attribute بأحد القيم التالية',
    'string' => 'يجب أن تكون :attribute سلسلة',
    'timezone' => 'يجب أن تكون :attribute منطقة صالحة',
    'unique' => 'تم استخدام :attribute بالفعل',
    'uploaded' => 'فشل تحميل :attribute',
    'url' => 'تنسيق :attribute غير صالح',
    'uuid' => 'يجب أن تكون :attribute UUID صالحًا',

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
            'rule-name' => 'تعديل رساله',
            'recaptcha' => 'مهلا!!! : :attribute خاطئة!',
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
        'email' => 'البريد الالكترونى',
        'term_and_condition' => 'الشروط والاحكام',
        'password' => 'الرقم السري',
        'password_confirmation' => 'تاكيد كلمة السر',
        'gender' => 'الجنس',
        'phone' => 'الهاتف',
        'email_phone' => ' الهاتف او البريد ',
    ],

];
