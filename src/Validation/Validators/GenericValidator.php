<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;

/**
 * Class GenericValidator
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
class GenericValidator extends AbstractValidator
{
    /**
     * @return boolean
     */
    protected function contraintNeedsValidation(): bool
    {
        return false;
    }

    /**
     * @param $value
     * @param ConstraintInterface $constraint
     * @return mixed
     */
    protected function doValidation()
    {
        return;
    }
}