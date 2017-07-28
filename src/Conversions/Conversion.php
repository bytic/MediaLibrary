<?php

namespace ByTIC\MediaLibrary\Conversions;

/**
 * Class Conversion
 * @package ByTIC\MediaLibrary\Convertions
 */
class Conversion
{
    protected $manipulations;

    /** @var array */
    protected $performOnCollections = [];

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->manipulations = (new Manipulations())->format('jpg');
    }

    public static function create(string $name)
    {
        return new static($name);
    }

    /**
     * Set the collection names on which this conversion must be performed.
     * @param array ...$collectionNames
     * @return $this
     */
    public function performOnCollections(...$collectionNames)
    {
        $this->performOnCollections = $collectionNames;
        return $this;
    }

    /**
     * Determine if this conversion should be performed on the given
     * collection.
     * @param string $collectionName
     * @return bool
     */
    public function shouldBePerformedOn(string $collectionName): bool
    {
        //if no collections were specified, perform conversion on all collections
        if (!count($this->performOnCollections)) {
            return true;
        }
        if (in_array('*', $this->performOnCollections)) {
            return true;
        }
        return in_array($collectionName, $this->performOnCollections);
    }

}
