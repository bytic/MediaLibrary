<?php

namespace ByTIC\MediaLibrary\Conversions;

use ByTIC\MediaLibrary\Conversions\Manipulations\Manipulation;
use ByTIC\MediaLibrary\Conversions\Manipulations\ManipulationSequence;

/**
 * Class Conversion
 * @package ByTIC\MediaLibrary\Convertions
 */
class Conversion
{
    /** @var string */
    protected $name = '';

    protected $manipulations;

    /** @var array */
    protected $performOnCollections = [];

    /**
     * Conversion constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->manipulations = (new ManipulationSequence());
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
//        if (!method_exists($this->manipulations, $name)) {
//            throw new BadMethodCallException("Manipulation `{$name}` does not exist");
//        }
        $this->manipulations[] = Manipulation::create($name, $arguments);
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Conversion
     */
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

    /**
     * @return ManipulationSequence
     */
    public function getManipulations(): ManipulationSequence
    {
        return $this->manipulations;
    }
}
