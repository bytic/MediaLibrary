<?php

use Mockery as m;
use Nip\Cache\Stores\Repository;
use Nip\Config\Config;
use Nip\Container\Container;
use Nip\Database\Connections\Connection;
use Nip\Inflector\Inflector;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require dirname(__DIR__) . '/vendor/autoload.php';

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');

$container = new Container();
Container::setInstance($container);

$container->set('inflector', new Inflector());
$container->set('config', new Config());

$connection = new Connection(false);
$adapter = m::namedMock('TestAdapter', \Nip\Database\Adapters\MySQLi::class)->makePartial()
    ->shouldReceive('query')->andReturn(true)
    ->shouldReceive('lastInsertID')->andReturn(99)
    ->shouldReceive('cleanData')->andReturnUsing(
        function ($arg) {
            return $arg;
        }
    )
    ->getMock();
$connection->setAdapter($adapter);
Container::getInstance()->set('db.connection', $connection);

$adapter = new ArrayAdapter();
$store = new Repository($adapter);
$container->set('cache.store', $store);
