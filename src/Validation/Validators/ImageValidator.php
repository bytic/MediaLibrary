<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;
use ByTIC\MediaLibrary\Validation\Constraints\ImageConstraint;

/**
 * Class ImageValidator
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
class ImageValidator extends AbstractValidator
{

    /**
     * @param ConstraintInterface|ImageConstraint $constraint
     * @return boolean
     */
    protected function contraintNeedsValidation(ConstraintInterface $constraint): bool
    {
        if (null === $constraint->minWidth && null === $constraint->maxWidth
            && null === $constraint->minHeight && null === $constraint->maxHeight
            && null === $constraint->minPixels && null === $constraint->maxPixels
            && null === $constraint->minRatio && null === $constraint->maxRatio
            && $constraint->allowSquare && $constraint->allowLandscape && $constraint->allowPortrait
            && !$constraint->detectCorrupted
        ) {
            return false;
        }
        return true;
    }


    /**
     * @param $value
     * @param ConstraintInterface $constraint
     * @return mixed
     */
    protected function doValidation($value, ConstraintInterface $constraint)
    {
        // TODO: Implement doValidation() method.
    }
}