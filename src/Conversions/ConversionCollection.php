<?php

namespace ByTIC\MediaLibrary\Conversions;

/**
 * Class ConversionCollection.
 */
class ConversionCollection extends \Nip\Collections\AbstractCollection
{
    /**
     * Get all the conversions in the collection.
     *
     * @param string $collectionName
     *
     * @return $this
     */
    public function forCollection(string $collectionName = '')
    {
        if ($collectionName === '') {
            return $this;
        }

        return $this->shouldBePerformedOn($collectionName);
    }

    /**
     * @param string $collectionName
     *
     * @return $this
     */
    protected function shouldBePerformedOn($collectionName)
    {
        $results = [];
        foreach ($this as $key=>$item) {
            /** @var Conversion $item */
            if ($item->shouldBePerformedOn($collectionName)) {
                $results[$key] = $item;
            }
        }

        return new self($results);
    }
}
