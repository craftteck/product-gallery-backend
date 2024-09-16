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

    'accepted' => ':attribute は受け入れられる必要があります。',
    'accepted_if' => ':other が :value のとき、:attribute は受け入れられる必要があります。',
    'active_url' => ':attribute は有効なURLである必要があります。',
    'after' => ':attribute は :date 以降の日付である必要があります。',
    'after_or_equal' => ':attribute は :date 以降の日付である必要があります。',
    'alpha' => ':attribute は文字のみを含む必要があります。',
    'alpha_dash' => ':attribute は文字、数字、ダッシュ、アンダースコアのみを含む必要があります。',
    'alpha_num' => ':attribute は文字と数字のみを含む必要があります。',
    'array' => ':attribute は配列である必要があります。',
    'ascii' => ':attribute は単一バイトの英数字と記号のみを含む必要があります。',
    'before' => ':attribute は :date より前の日付である必要があります。',
    'before_or_equal' => ':attribute は :date 以下の日付である必要があります。',
    'between' => [
        'array' => ':attribute は :min から :max のアイテムを含む必要があります。',
        'file' => ':attribute は :min から :max キロバイトである必要があります。',
        'numeric' => ':attribute は :min から :max の間の値である必要があります。',
        'string' => ':attribute は :min から :max 文字の間である必要があります。',
    ],
    'boolean' => ':attribute は true または false である必要があります。',
    'can' => ':attribute には許可されていない値が含まれています。',
    'confirmed' => ':attribute の確認が一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute は有効な日付である必要があります。',
    'date_equals' => ':attribute は :date と同じ日付である必要があります。',
    'date_format' => ':attribute は :format の形式と一致する必要があります。',
    'decimal' => ':attribute は :decimal 桁の小数である必要があります。',
    'declined' => ':attribute は拒否される必要があります。',
    'declined_if' => ':other が :value のとき、:attribute は拒否される必要があります。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁である必要があります。',
    'digits_between' => ':attribute は :min から :max 桁の間である必要があります。',
    'dimensions' => ':attribute には無効な画像サイズがあります。',
    'distinct' => ':attribute には重複する値があります。',
    'doesnt_end_with' => ':attribute は次のいずれかで終わってはなりません: :values。',
    'doesnt_start_with' => ':attribute は次のいずれかで始まってはなりません: :values。',
    'email' => ':attribute は有効なメールアドレスである必要があります。',
    'ends_with' => ':attribute は次のいずれかで終わる必要があります: :values。',
    'enum' => '選択された :attribute は無効です。',
    'exists' => '選択された :attribute は無効です。',
    'extensions' => ':attribute は次の拡張子のいずれかを持つ必要があります: :values。',
    'file' => ':attribute はファイルである必要があります。',
    'filled' => ':attribute には値が必要です。',
    'gt' => [
        'array' => ':attribute は :value 以上のアイテムを含む必要があります。',
        'file' => ':attribute は :value キロバイトより大きい必要があります。',
        'numeric' => ':attribute は :value より大きい必要があります。',
        'string' => ':attribute は :value 文字より多い必要があります。',
    ],
    'gte' => [
        'array' => ':attribute は :value アイテム以上を含む必要があります。',
        'file' => ':attribute は :value キロバイト以上である必要があります。',
        'numeric' => ':attribute は :value 以上である必要があります。',
        'string' => ':attribute は :value 文字以上である必要があります。',
    ],
    'hex_color' => ':attribute は有効な16進数の色である必要があります。',
    'image' => ':attribute は画像である必要があります。',
    'in' => '選択された :attribute は無効です。',
    'in_array' => ':attribute は :other に存在する必要があります。',
    'integer' => ':attribute は整数である必要があります。',
    'ip' => ':attribute は有効なIPアドレスである必要があります。',
    'ipv4' => ':attribute は有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attribute は有効なIPv6アドレスである必要があります。',
    'json' => ':attribute は有効なJSON文字列である必要があります。',
    'list' => ':attribute はリストである必要があります。',
    'lowercase' => ':attribute は小文字である必要があります。',
    'lt' => [
        'array' => ':attribute は :value 未満のアイテムを含む必要があります。',
        'file' => ':attribute は :value キロバイト未満である必要があります。',
        'numeric' => ':attribute は :value 未満である必要があります。',
        'string' => ':attribute は :value 文字未満である必要があります。',
    ],
    'lte' => [
        'array' => ':attribute は :value アイテムを超えてはなりません。',
        'file' => ':attribute は :value キロバイト以下である必要があります。',
        'numeric' => ':attribute は :value 以下である必要があります。',
        'string' => ':attribute は :value 文字以下である必要があります。',
    ],
    'mac_address' => ':attribute は有効なMACアドレスである必要があります。',
    'max' => [
        'array' => ':attribute は :max アイテムを超えてはなりません。',
        'file' => ':attribute は :max キロバイト以下である必要があります。',
        'numeric' => ':attribute は :max 以下である必要があります。',
        'string' => ':attribute は :max 文字以下である必要があります。',
    ],
    'max_digits' => ':attribute は :max 桁以下である必要があります。',
    'mimes' => ':attribute は次のタイプのファイルである必要があります: :values。',
    'mimetypes' => ':attribute は次のタイプのファイルである必要があります: :values。',
    'min' => [
        'array' => ':attribute は少なくとも :min アイテムを含む必要があります。',
        'file' => ':attribute は少なくとも :min キロバイトである必要があります。',
        'numeric' => ':attribute は少なくとも :min である必要があります。',
        'string' => ':attribute は少なくとも :min 文字である必要があります。',
    ],
    'min_digits' => ':attribute は少なくとも :min 桁である必要があります。',
    'missing' => ':attribute は存在してはなりません。',
    'missing_if' => ':other が :value のとき、:attribute は存在してはなりません。',
    'missing_unless' => ':other が :value でない限り、:attribute は存在してはなりません。',
    'missing_with' => ':values が存在する場合、:attribute は存在してはなりません。',
    'missing_with_all' => ':values がすべて存在する場合、:attribute は存在してはなりません。',
    'multiple_of' => ':attribute は :value の倍数である必要があります。',
    'not_in' => '選択された :attribute は無効です。',
    'not_regex' => ':attribute の形式が無効です。',
    'numeric' => ':attribute は数字である必要があります。',
    'password' => [
        'letters' => ':attribute は少なくとも1文字を含む必要があります。',
        'mixed' => ':attribute は少なくとも1つの大文字と小文字を含む必要があります。',
        'numbers' => ':attribute は少なくとも1つの数字を含む必要があります。',
        'symbols' => ':attribute は少なくとも1つの記号を含む必要があります。',
        'uncompromised' => '指定された :attribute はデータ漏洩で公開されました。他の :attribute を選んでください。',
    ],
    'present' => ':attribute は存在する必要があります。',
    'present_if' => ':other が :value のとき、:attribute は存在する必要があります。',
    'present_unless' => ':other が :value でない限り、:attribute は存在する必要があります。',
    'present_with' => ':values が存在する場合、:attribute は存在する必要があります。',
    'present_with_all' => ':values がすべて存在する場合、:attribute は存在する必要があります。',
    'prohibited' => ':attribute は禁止されています。',
    'prohibited_if' => ':other が :value のとき、:attribute は禁止されています。',
    'prohibited_unless' => ':other が :values のいずれかでない限り、:attribute は禁止されています。',
    'prohibits' => ':attribute は :other が存在することを禁止しています。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute は必須です。',
    'required_array_keys' => ':attribute には次のエントリが含まれている必要があります: :values。',
    'required_if' => ':other が :value のとき、:attribute は必須です。',
    'required_if_accepted' => ':other が受け入れられるとき、:attribute は必須です。',
    'required_if_declined' => ':other が拒否されたとき、:attribute は必須です。',
    'required_unless' => ':other が :values に含まれていない限り、:attribute は必須です。',
    'required_with' => ':values が存在する場合、:attribute は必須です。',
    'required_with_all' => ':values がすべて存在する場合、:attribute は必須です。',
    'required_without' => ':values が存在しない場合、:attribute は必須です。',
    'required_without_all' => ':values がすべて存在しない場合、:attribute は必須です。',
    'same' => ':attribute は :other と一致する必要があります。',
    'size' => [
        'array' => ':attribute は :size アイテムを含む必要があります。',
        'file' => ':attribute は :size キロバイトである必要があります。',
        'numeric' => ':attribute は :size である必要があります。',
        'string' => ':attribute は :size 文字である必要があります。',
    ],
    'starts_with' => ':attribute は次のいずれかで始まる必要があります: :values。',
    'string' => ':attribute は文字列である必要があります。',
    'timezone' => ':attribute は有効なタイムゾーンである必要があります。',
    'unique' => ':attribute はすでに使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'uppercase' => ':attribute は大文字である必要があります。',
    'url' => ':attribute は有効なURLである必要があります。',
    'ulid' => ':attribute は有効なULIDである必要があります。',
    'uuid' => ':attribute は有効なUUIDである必要があります。',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
