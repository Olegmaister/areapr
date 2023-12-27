<?php
/**@var $params array**/
return [
    'class' => '\yii\web\UrlManager',
    'baseUrl' => '',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        '<_a:signup>' => 'signup/<_a>',
        '<_a:login|logout>' => 'auth/<_a>',
        'password/request' => 'password/request',
        'cabinet/<page:\d+>/<per-page:\d+>' => 'cabinet/index',
        'purchase/edit/<id:\d+>' => 'purchase/edit',
        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];
