<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
    ],
    'modules'=>[
        'manage' => [
            'class' => 'backend\modules\manage\Modules',
        ],
        'authorization' => [
            'class' => 'backend\modules\authorization\Modules',
        ],
    ],
    'timeZone'=>'Asia/Ho_Chi_Minh',
];
