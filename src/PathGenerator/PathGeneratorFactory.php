<?php

namespace ByTIC\MediaLibrary\PathGenerator;

/**
 * Class PathGeneratorFactory
 * @package ByTIC\MediaLibrary\PathGenerator
 */
class PathGeneratorFactory
{
    /**
     * @return AbstractPathGenerator
     */
    public static function create()
    {
        $pathGeneratorClass = BasePathGenerator::class;
//        $customPathClass = config('medialibrary.custom_path_generator_class');
//        if ($customPathClass) {
//            $pathGeneratorClass = $customPathClass;
//        }
//        static::guardAgainstInvalidPathGenerator($pathGeneratorClass);
        return app($pathGeneratorClass);
    }

}