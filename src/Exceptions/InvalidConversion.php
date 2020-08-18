<?php

namespace ByTIC\MediaLibrary\Exceptions;

use Exception;

/**
 * Class InvalidConversion
 * @package ByTIC\MediaLibrary\Exceptions
 */
class InvalidConversion extends Exception
{
    public static function unknownName(string $name): self
    {
        return new static("There is no conversion named `{$name}`");
    }
}