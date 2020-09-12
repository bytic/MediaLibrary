<?php

namespace ByTIC\MediaLibrary\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest.
 */
abstract class AbstractTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected $object;

    protected function tearDown() : void
    {
        \Mockery::close();
    }
}
