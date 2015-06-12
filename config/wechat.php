<?php
return [
    'use_alias' => env('WECHAT_USE_ALIAS', false),
    'app_id' => env('WECHAT_APPID', 'wx082956823088f473'), //必填
    'secret' => env('WECHAT_SECRET', '7344f69d271b71b61b1b817e573f5f90'), // 必填
    'token' => env('WECHAT_TOKEN', 'jlr'),  // 必填
    'encoding_key' => env('WECHAT_ENCODING_KEY', 'YourEncodingAESKey') // 加密模式需要，其它模式不需要
];