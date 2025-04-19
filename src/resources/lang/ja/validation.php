<?php

return [

    'required' => ':attribute は必須項目です。',
    'email' => ':attribute は有効なメールアドレス形式で入力してください。',
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'confirmed' => ':attribute と確認用が一致しません。',
    'unique' => ':attribute は既に使用されています。',

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],

];
