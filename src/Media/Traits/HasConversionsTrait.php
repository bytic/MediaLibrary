<?php

namespace ByTIC\MediaLibrary\Media\Traits;

use ByTIC\MediaLibrary\Conversions\ConversionCollection;

/**
 * Trait HasConversionsTrait
 * @package ByTIC\MediaLibrary\Media\Traits
 */
trait HasConversionsTrait
{
    protected $conversions = null;

    protected $conversionNames;

    public function getConversionNames(): array
    {
        if ($this->conversionNames == null) {
            $this->conversionNames = $this->generateConversionNames();
        }
        return $this->conversionNames;
    }

    /**
     * @return array
     */
    protected function generateConversionNames()
    {
        $conversions = $this->getConversions();

        $return = [];
        foreach ($conversions as $conversion) {
            $return[] = $conversion->getName();
        }
        return $return;
    }

    public function getConversions(): ConversionCollection
    {
        if ($this->conversions == null) {
            $this->conversions = $this->generateConversions();
        }
        return $this->conversions;
    }

    /**
     * @return ConversionCollection
     */
    protected function generateConversions()
    {
        $collection = $this->getCollection();
        $model = $this->getModel();
        if ($collection && $model) {
            return $model->getMediaConversions()->forCollection($collection->getName());
        }
        return new ConversionCollection();
    }

}
