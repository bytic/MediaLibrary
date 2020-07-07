<?php

namespace ByTIC\MediaLibrary\HasMedia\Interfaces;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Conversions\ConversionCollection;

/**
 * Interface HasMediaConversions.
 */
interface HasMediaConversions extends HasMedia
{
    /**
     * Add a conversion.
     *
     * @param string $name
     *
     * @return Conversion
     */
    public function addMediaConversion(string $name): Conversion;

    public function getMediaConversions(): ConversionCollection;
}
