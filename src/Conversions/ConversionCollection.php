<?php

namespace ByTIC\MediaLibrary\Conversions;

use ByTIC\MediaLibrary\Exceptions\InvalidConversion;
use Nip\Collections\AbstractCollection;

/**
 * Class ConversionCollection.
 */
class ConversionCollection extends AbstractCollection
{
    public function getByName(string $name): Conversion
    {
        $conversion = $this->first(function (Conversion $conversion) use ($name) {
            return $conversion->getName() === $name;
        });

        if (!$conversion) {
            throw InvalidConversion::unknownName($name);
        }

        return $conversion;
    }

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
        foreach ($this as $key => $item) {
            /** @var Conversion $item */
            if ($item->shouldBePerformedOn($collectionName)) {
                $results[$key] = $item;
            }
        }

        return new self($results);
    }
}
