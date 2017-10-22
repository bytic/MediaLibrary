<?php

namespace ByTIC\MediaLibrary\HasMedia\Traits;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\FileAdder\FileAdderFactory;

/**
 * Trait AddMediaTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait AddMediaTrait
{
    /**
     * @param string|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string $collection
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
        return app(FileAdderFactory::class)->create($this, $file);
    }
}