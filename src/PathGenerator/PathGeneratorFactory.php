<?php

namespace ByTIC\MediaLibrary\PathGenerator;

/**
 * Class PathGeneratorFactory.
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
        if (function_exists('app') && app()) {
            return app($pathGeneratorClass);
        }

        return new $pathGeneratorClass();
    }
}
