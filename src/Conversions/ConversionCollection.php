<?php

namespace ByTIC\MediaLibrary\Conversions;

/**
 * Class ConversionCollection
 * @package ByTIC\MediaLibrary\Convertions
 */
class ConversionCollection extends \Nip\Collection
{
    /**
     * Get all the conversions in the collection.
     *
     * @param string $collectionName
     *
     * @return $this
     */
    public function getConversions(string $collectionName = '')
    {
        if ($collectionName === '') {
            return $this;
        }
        return $this->shouldBePerformedOn($collectionName);
    }

    /**
     * @param string $collectionName
     * @return $this
     */
    protected function shouldBePerformedOn($collectionName)
    {
        $results = [];
        foreach ($this as $key=>$item) {
            if ($item->shouldBePerformedOn($collectionName)) {
                $results[$key] = $item;
            }
        }
        return new self($results);
    }
}
