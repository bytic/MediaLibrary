<?php

namespace ByTIC\MediaLibrary\Tests\HasMedia;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Conversions\ConversionCollection;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\HasMediaModel;

/**
 * Class HasMediaConversionsTest.
 */
class HasMediaConversionsTest extends AbstractTest
{
    public function testGetMediaConversionsEmpty()
    {
        $model = new HasMediaModel();

        $conversions = $model->getMediaConversions();
        self::assertInstanceOf(ConversionCollection::class, $conversions);
        self::assertFalse($model->hasMediaConversions());

        $model->addMediaConversion('thumb');
        self::assertTrue($model->hasMediaConversions());
    }

    public function testAddMediaConversion()
    {
        $model = new HasMediaModel();
        $conversions = $model->getMediaConversions();
        self::assertInstanceOf(ConversionCollection::class, $conversions);
        self::assertEquals(0, $conversions->count());

        $conversion = $model->addMediaConversion('thumb');
        self::assertInstanceOf(Conversion::class, $conversion);
        self::assertEquals(1, $conversions->count());
        self::assertSame($conversion, $conversions->get('thumb'));
    }
}
