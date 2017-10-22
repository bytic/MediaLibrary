<?php

namespace ByTIC\MediaLibrary\Tests\Conversions\Manipulations;

use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Tests\AbstractTest;

/**
 * Class ManipulationTest
 * @package ByTIC\MediaLibrary\Tests\Conversions\Manipulations
 */
class ManipulationTest extends AbstractTest
{
    public function testContruct()
    {
        $manipulation = new Manipulation('resize', 150, 200);
        self::assertSame('resize', $manipulation->getName());
        self::assertSame([150, 200], $manipulation->getAttributes());
    }

    public function testStaticCreate()
    {
        $manipulation = Manipulation::create('resize', 150, 200);
        self::assertSame('resize', $manipulation->getName());
        self::assertSame([150, 200], $manipulation->getAttributes());
    }
}
