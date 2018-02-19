<?php

declare(strict_types=1);

/*
 * This file is part of the yii2lib/example.
 * (c) frontbear <frontbear@outlook.com>
 * This source file is subject to the BSD-3-Clause license that is bundled.
 */

namespace yii2lib\tests\unit\example;

use Yii;
use yii\console\Application as ConsoleApplication;
use yii\db\Connection as DbConnection;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use PHPUnit\Framework\TestCase as UnitTestCase;

class TestCase extends UnitTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mockApplication();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        // destroy application
        Yii::$app = null;
        // remove test directory
        FileHelper::removeDirectory($this->getTestDirectoryPath());
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = ConsoleApplication::class): void
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => dirname(__DIR__) . '/vendor',
            'components' => [
                'db' => [
                    'class' => DbConnection::class,
                    'dsn' => 'sqlite::memory:',
                ],
            ],
        ], $config));
    }

    /**
     * get test directory path, also ensures that path exists
     * @return string test file path
     * @throws \yii\base\Exception
     */
    protected function getTestDirectoryPath(): string
    {
        $path = Yii::getAlias('@runtime/example-test');

        // ensures the path exists
        FileHelper::createDirectory($path);

        return $path;
    }
}
