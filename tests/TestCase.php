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

/**
 * Base class for the test cases.
 */
class TestCase extends \PHPUnit\Framework\TestCase
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
        $this->destroyApplication();
        $this->removeTestFilePath();
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
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => DbConnection::class,
                    'dsn' => 'sqlite::memory:',
                ],
            ],
        ], $config));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath(): string
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication(): void
    {
        Yii::$app = null;
    }

    /**
     * @return string test file path
     */
    protected function getTestFilePath(): string
    {
        return Yii::getAlias('@runtime/example-test');
    }

    /**
     * Ensures test file path exists.
     * @return string test file path
     * @throws \yii\base\Exception
     */
    protected function ensureTestFilePath(): string
    {
        $path = $this->getTestFilePath();
        FileHelper::createDirectory($path);

        return $path;
    }

    /**
     * Removes the test file path.
     * @throws \yii\base\ErrorException
     */
    protected function removeTestFilePath(): void
    {
        $path = $this->getTestFilePath();
        FileHelper::removeDirectory($path);
    }

    /**
     * Invokes object method, even if it is private or protected.
     * @param object $object object
     * @param string $method method name
     * @param array $args method arguments
     * @return mixed method result
     * @throws \ReflectionException
     */
    protected function invoke($object, $method, array $args = [])
    {
        $classReflection = new \ReflectionClass(get_class($object));
        $methodReflection = $classReflection->getMethod($method);
        $methodReflection->setAccessible(true);
        $result = $methodReflection->invokeArgs($object, $args);
        $methodReflection->setAccessible(false);

        return $result;
    }
}
