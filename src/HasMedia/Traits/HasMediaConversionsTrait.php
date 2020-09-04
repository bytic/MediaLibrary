<?php

namespace ByTIC\MediaLibrary\HasMedia\Traits;

use ByTIC\MediaLibrary\Conversions\Conversion;
use ByTIC\MediaLibrary\Conversions\ConversionCollection;

/**
 * Trait HasMediaConversionsTrait.
 */
trait HasMediaConversionsTrait
{
    public $mediaConversions = null;

    /**
     * Add a conversion.
     *
     * @param string $name
     *
     * @return Conversion
     */
    public function addMediaConversion(string $name): Conversion
    {
        $conversion = Conversion::create($name);
        $this->mediaConversions[$name] = $conversion;

        return $conversion;
    }

    /**
     * @return ConversionCollection
     */
    public function getMediaConversions(): ConversionCollection
    {
        if ($this->mediaConversions === null) {
            $this->initMediaConversions();
        }

        return $this->mediaConversions;
    }

    /**
     * @return bool
     */
    public function hasMediaConversions()
    {
        return $this->getMediaConversions()->isNotEmpty();
    }

    protected function initMediaConversions()
    {
        $this->mediaConversions = new ConversionCollection();

        if (method_exists($this, 'registerMediaConversions')) {
            $this->registerMediaConversions();
        }
    }
}
