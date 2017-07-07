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
     * @param ConstraintInterface $constraint
     * @return boolean
     */
    protected function contraintNeedsValidation(ConstraintInterface $constraint): bool
    {
        return false;
    }

    /**
     * @param $value
     * @param ConstraintInterface $constraint
     * @return mixed
     */
    protected function doValidation($value, ConstraintInterface $constraint)
    {
        return;
    }
}