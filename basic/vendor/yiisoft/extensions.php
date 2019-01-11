<?php

$vendorDir = dirname(__DIR__);

return array (
  'yiisoft/yii2-swiftmailer' => 
  array (
    'name' => 'yiisoft/yii2-swiftmailer',
    'version' => '2.0.7.0',
    'alias' => 
    array (
      '@yii/swiftmailer' => $vendorDir . '/yiisoft/yii2-swiftmailer',
    ),
  ),
  'yiisoft/yii2-bootstrap' => 
  array (
    'name' => 'yiisoft/yii2-bootstrap',
    'version' => '2.0.8.0',
    'alias' => 
    array (
      '@yii/bootstrap' => $vendorDir . '/yiisoft/yii2-bootstrap/src',
    ),
  ),
  'yiisoft/yii2-debug' => 
  array (
    'name' => 'yiisoft/yii2-debug',
    'version' => '2.0.13.0',
    'alias' => 
    array (
      '@yii/debug' => $vendorDir . '/yiisoft/yii2-debug',
    ),
  ),
  'yiisoft/yii2-gii' => 
  array (
    'name' => 'yiisoft/yii2-gii',
    'version' => '2.0.6.0',
    'alias' => 
    array (
      '@yii/gii' => $vendorDir . '/yiisoft/yii2-gii',
    ),
  ),
  'yiisoft/yii2-faker' => 
  array (
    'name' => 'yiisoft/yii2-faker',
    'version' => '2.0.4.0',
    'alias' => 
    array (
      '@yii/faker' => $vendorDir . '/yiisoft/yii2-faker',
    ),
  ),
  'creocoder/yii2-flysystem' => 
  array (
    'name' => 'creocoder/yii2-flysystem',
    'version' => '0.9.3.0',
    'alias' => 
    array (
      '@creocoder/flysystem' => $vendorDir . '/creocoder/yii2-flysystem/src',
    ),
  ),
  'beaten-sect0r/yii2-db-manager' => 
  array (
    'name' => 'beaten-sect0r/yii2-db-manager',
    'version' => '2.2.0.0',
    'alias' => 
    array (
      '@bs/dbManager' => $vendorDir . '/beaten-sect0r/yii2-db-manager/src',
    ),
    'bootstrap' => 'bs\\dbManager\\Bootstrap',
  ),
);
