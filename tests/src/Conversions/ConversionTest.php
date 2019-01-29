<?php

namespace ByTIC\MediaLibrary\Tests\Conversions;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use ByTIC\MediaLibrary\Tests\AbstractTest;

/**
 * Class ConversionTest.
 */
class ConversionTest extends AbstractTest
{
    public function testCreate()
    {
        $conversion = Conversion::create('thumb');
        self::assertSame('thumb', $conversion->getName());

        $manipulations = $conversion->getManipulations();
        self::assertInstanceOf(ManipulationSequence::class, $manipulations);
        self::assertEquals(0, $manipulations->count());
    }

    public function testAddSameNameManipulation()
    {
        $conversion = Conversion::create('thumb');
        $conversion->resize(100, 200);
        $conversion->resize(300, 400);

        $manipulations = $conversion->getManipulations();
        self::assertInstanceOf(ManipulationSequence::class, $manipulations);
        self::assertEquals(2, $manipulations->count());
    }

    public function testCreateManipulation()
    {
        $conversion = Conversion::create('thumb');
        $conversion->resize(100, 200);

        /** @var Manipulation $manipulation */
        $manipulation = $conversion->getManipulations()[0];
        self::assertInstanceOf(Manipulation::class, $manipulation);
        self::assertEquals('resize', $manipulation->getName());
        self::assertEquals([100, 200], $manipulation->getAttributes());
    }
}
