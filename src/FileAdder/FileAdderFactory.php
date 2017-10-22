<?php

namespace ByTIC\MediaLibrary\FileAdder;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class FileAdderFactory
 * @package ByTIC\MediaLibrary\FileAdder
 */
class FileAdderFactory
{

    /**
     * @param HasMediaTrait $subject
     * @param string|\Symfony\Component\HttpFoundation\File\File $file
     *
     * @return FileAdder
     */
    public static function create($subject, $file)
    {
        return app(FileAdder::class)
            ->setSubject($subject)
            ->setFile($file);
    }

}