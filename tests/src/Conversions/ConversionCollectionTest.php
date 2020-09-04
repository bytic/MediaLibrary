<?php

namespace ByTIC\MediaLibrary\Tests\Conversions;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Conversions\ConversionCollection;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;
use ByTIC\MediaLibrary\Tests\AbstractTest;

/**
 * Class ConversionCollectionTest
 * @package ByTIC\MediaLibrary\Tests\Conversions
 */
class ConversionCollectionTest extends AbstractTest
{
    public function test_getByName()
    {
        $collection = new ConversionCollection();

        $collection->add(Conversion::create('conv1'));
        $collection->add(Conversion::create('conv2'));

        $conv = $collection->getByName('conv2');
        self::assertInstanceOf(Conversion::class, $conv);
        self::assertSame('conv2', $conv->getName());
    }
}
