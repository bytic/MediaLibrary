<?php

namespace ByTIC\MediaLibrary\HasMedia\Traits;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\FileAdder\FileAdderFactory;

/**
 * Trait AddMediaTrait.
 */
trait AddMediaTrait
{
    /**
     * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string                                                     $collection
     *
     * @return FileAdder
     */
    public function addMediaToCollection($file, $collection)
    {
        $fileAdder = $this->addMedia($file);
        $fileAdder->toMediaCollection($collection);

        return $fileAdder;
    }

    /**
     * Add a file to the medialibrary.
     *
     * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return FileAdder
     */
    public function addMedia($file)
    {
        return call_user_func_array(
            [self::getFileAdderFactory(), 'create'],
            [$this, $file]
        );
    }

    /**
     * @return FileAdderFactory|string
     */
    public static function getFileAdderFactory()
    {
        if (function_exists('app')) {
            return app(FileAdderFactory::class);
        }

        return FileAdderFactory::class;
    }
}
