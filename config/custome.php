<?php
return [
    'weixin' => [
        'name'   => '填写公众号名称',
        'appid'  => env('WEIXIN_APPID'),
        'secret' => env('WEIXIN_SECRET'),
    ],
    
    'super_user' => [
        'username'=>env('SUPER_USER_USERNAME'),
        'password'=>env('SUPER_USER_PASSWORD'),
        'email'   =>env('SUPER_USER_EMAIL', '1250857765@qq.com'),
    ],
];
