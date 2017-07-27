<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Conversions\ConversionCollection;

/**
 * Trait HasMediaConversionsTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaConversionsTrait
{
    public $mediaConversions = null;

    /**
     * @return null
     */
    public function getMediaConversions()
    {
        if ($this->mediaConversions === null) {
            $this->initMediaConversions();
        }
        return $this->mediaConversions;
    }

    protected function initMediaConversions()
    {
        $this->mediaConversions = new ConversionCollection();
    }
}
