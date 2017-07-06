<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

/**
 * Class GenericValidator
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
class GenericValidator
{

    /**
     * @param $file
     * @param $validatorGroups
     */
    public static function validate($file, $validatorGroups)
    {
        $validator = \Validator::make($data, $rules, $messages);
    }


}