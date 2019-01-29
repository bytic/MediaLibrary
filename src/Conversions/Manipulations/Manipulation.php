<?php

namespace ByTIC\MediaLibrary\Conversions\Manipulations;

/**
 * Class Manipulation.
 */
class Manipulation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Manipulation constructor.
     *
     * @param string $name
     * @param array  $attributes
     */
    public function __construct($name, ...$attributes)
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    /**
     * @param $name
     * @param array ...$atributes
     *
     * @return Manipulation
     */
    public static function create($name, ...$atributes)
    {
        return new self($name, ...$atributes);
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
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
