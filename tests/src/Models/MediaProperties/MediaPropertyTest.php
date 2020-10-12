<?php

namespace ByTIC\MediaLibrary\Tests\Models\MediaProperties;

use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperty;
use ByTIC\MediaLibrary\Tests\AbstractTest;

/**
 * Class MediaPropertyTest
 * @package ByTIC\MediaLibrary\Tests\Models\MediaProperties
 */
class MediaPropertyTest extends AbstractTest
{
    public function test_getCustomProperties_returns_empty_array()
    {
        $mediaProperty = new MediaProperty();
        $properties = $mediaProperty->getCustomProperties();
        self::assertSame([], $properties);
    }

    public function test_getCustomProperties_returns_array()
    {
        $mediaProperty = new MediaProperty();
        $mediaProperty->writeData(['custom_properties' => json_encode(['loaded' => true])]);
        $properties = $mediaProperty->getCustomProperties();
        self::assertSame(['loaded' => true], $properties);
    }
}
