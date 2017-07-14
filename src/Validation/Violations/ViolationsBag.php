<?php

namespace ByTIC\MediaLibrary\Validation\Violations;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Class MessageBag
 * @package ByTIC\MediaLibrary\Validation\Violations
 */
class ViolationsBag implements ArrayAccess, Countable, JsonSerializable, IteratorAggregate
{
    /**
     * All of the registered messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->count() == 0;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->messages);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->messages[$offset] : null;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return isset($this->messages[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        $this->messages[$offset] = $value;
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        unset($this->messages[$offset]);
    }

    /**
     * @inheritdoc
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->messages);
    }
}
