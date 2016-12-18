<?php
/**
 * Created by PhpStorm.
 * User: lesvere
 * Date: 16-12-16
 * Time: 下午1:27
 */

return [
    'driver'   => 'alidayu',
    'alidayu'  => [
        'app_key'    => env('MSMS_ALIDAYU_APP_KEY', 'app_key'),
        'app_secret' => env('MSMS_ALIDAYU_APP_SECRET', 'app_secret'),
        'env'        => 'production',       //sandbox
        'timezone'   => 'PRC',
    ],
    'webpower' => [
        'account'    => env('MSMS_WEBPOWER_ACCOUNT', 'account'),
        'password'   => env("MSMS_WEBPOWER_PASSWORD", md5('password')),
        'campaignID' => 1,
    ],
];