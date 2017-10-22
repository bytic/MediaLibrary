<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;

/**
 * Interface ValidatorInterface
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
interface ValidatorInterface
{
    /**
     * @param $file
     * @param ConstraintInterface $constraint
     * @return mixed
     */
    public function validate($file, ConstraintInterface $constraint = null);

}
