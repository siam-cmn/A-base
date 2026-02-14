<?php

$sf_required = '必須項目です。';
$sf_mustbe = 'である必要があります。';
$sf_ask = 'で入力してください。';
$sf_not = 'ではありません。';
$sf_file = 'のものを指定してください。';
$sf_invalid = 'は正しくありません。';

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

    'accepted' => ':attribute が有効'.$sf_not,
    'active_url' => ':attribute が有効なURL'.$sf_not,
    'after' => ':attribute は :date 以降の日付'.$sf_ask,
    'alpha' => ':attribute は半角英字のみ'.$sf_ask,
    'alpha_dash' => ':attribute は半角英字、-(ハイフン)、_(アンダースコア)'.$sf_ask,
    'alpha_num' => ':attribute は半角英数字のみ'.$sf_ask,
    'array' => ':attribute はリスト形式で'.$sf_mustbe,
    'before' => ':attribute は :date 以前の日付'.$sf_ask,
    'between' => [
        'numeric' => ':attribute は :min から :max の間の値'.$sf_ask,
        'file' => ':attribute は :min KB から :max KB '.$sf_file,
        'string' => ':attribute は :min から :max もじ'.$sf_ask,
        'array' => ':attribute は :min から :max までの要素数'.$sf_mustbe,
    ],
    'boolean' => ':attribute は TRUE もしくは FALSE '.$sf_mustbe,
    'confirmed' => ':attribute が確認されていません。',
    'date' => ':attribute は有効な日付'.$sf_not,
    'date_format' => ':attribute は :format に合致していません。',
    'different' => ':attribute と :other は異なる値'.$sf_mustbe,
    'digits' => ':attribute は :digits '.$sf_mustbe,
    'digits_between' => ':attribute は :min から :max の間'.$sf_ask,
    'email' => ':attribute は有効なメールアドレス'.$sf_not,
    'exists' => '選択された :attribute '.$sf_invalid,
    'image' => ':attribute は画像'.$sf_mustbe,
    'in' => '選択された :attribute '.$sf_invalid,
    'integer' => ':attribute は整数'.$sf_mustbe,
    'ip' => ':attribute は有効な IP address '.$sf_mustbe,
    'max' => [
        'numeric' => ':attribute は :max 以下の数値'.$sf_ask,
        'file' => ':attribute は :max KB 以下'.$sf_file,
        'string' => ':attribute は :max 文字以内'.$sf_ask,
        'array' => ':attribute は :max 以下の要素数'.$sf_ask,
    ],
    'mimes' => ':attribute は以下のファイル形式'.$sf_mustbe.' フォーマット: :values',
    'min' => [
        'numeric' => ':attribute は :min 以上の数値'.$sf_ask,
        'file' => ':attribute は :min KB 以上'.$sf_file,
        'string' => ':attribute は :min 文字以上'.$sf_ask,
        'array' => ':attribute は :min 以上の要素数'.$sf_ask,
    ],
    'not_in' => '選択された :attribute '.$sf_invalid,
    'numeric' => ':attribute は数値'.$sf_mustbe,
    'regex' => ':attribute の形式'.$sf_invalid,
    'required' => ':attribute は'.$sf_required,
    'required_if' => ':attribute は :other が :value の場合は'.$sf_required,
    'required_with' => ':attribute は :values が入力済の場合は'.$sf_required,
    'required_with_all' => ':attribute は :values が入力済の場合は'.$sf_required,
    'required_without' => ':attribute は :values が未入力の場合は'.$sf_required,
    'required_without_all' => ':attribute は :values が全て未入力の場合は'.$sf_required,
    'same' => ':attribute と :other は同じ'.$sf_mustbe,
    'size' => [
        'numeric' => ':attribute は :size '.$sf_mustbe,
        'file' => ':attribute は :size KB '.$sf_mustbe,
        'string' => ':attribute は :size 文字'.$sf_mustbe,
        'array' => ':attribute は :size の要素数'.$sf_mustbe,
    ],
    'unique' => ':attribute は既に使用されています。',
    'url' => ':attribute の形式'.$sf_invalid,
    'timezone' => ':attribute は正しいタイムゾーン'.$sf_mustbe,

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

    'attributes' => [
    ],

];
