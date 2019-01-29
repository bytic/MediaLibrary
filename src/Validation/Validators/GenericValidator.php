<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;

/**
 * Class GenericValidator.
 */
class GenericValidator extends AbstractValidator
{
    /**
     * @return bool
     */
    protected function contraintNeedsValidation(): bool
    {
        return false;
    }

    /**
     * @param $value
     * @param ConstraintInterface $constraint
     *
     * @return mixed
     */
    protected function doValidation()
    {
    }
}
