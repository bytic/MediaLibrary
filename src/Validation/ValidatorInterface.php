<?php

namespace ByTIC\MediaLibrary\Validation;

/**
 * Interface ValidatorInterface
 * @package ByTIC\MediaLibrary\Validation
 */
interface ValidatorInterface
{
    /**
     * @param $file
     * @return mixed
     */
    public static function validate($file, Constraint $constraint);
}
