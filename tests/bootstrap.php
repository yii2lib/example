<?php

declare(strict_types=1);

/*
 * This file is part of the yii2lib/example.
 * (c) frontbear <frontbear@outlook.com>
 * This source file is subject to the BSD-3-Clause license that is bundled.
 */

error_reporting(-1);

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);

$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@yii2lib/tests/unit/example', __DIR__);
Yii::setAlias('@yii2lib/example', dirname(__DIR__) . '/src');
