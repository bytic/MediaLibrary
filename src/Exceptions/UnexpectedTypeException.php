<?php

namespace ByTIC\MediaLibrary\Exceptions;

/**
 * Class UnexpectedTypeException.
 */
class UnexpectedTypeException extends ValidatorException
{
    /**
     * UnexpectedTypeException constructor.
     *
     * @param string $value
     * @param int    $expectedType
     */
    public function __construct($value, $expectedType)
    {
        parent::__construct(
            sprintf(
                'Expected argument of type "%s", "%s" given',
                $expectedType,
                is_object($value) ? get_class($value) : gettype($value)
            )
        );
    }
}
