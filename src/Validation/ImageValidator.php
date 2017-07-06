<?php

namespace ByTIC\MediaLibrary\Validation;

/**
 * Class ImageValidator
 * @package ByTIC\MediaLibrary\Validation
 */
class ImageValidator
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