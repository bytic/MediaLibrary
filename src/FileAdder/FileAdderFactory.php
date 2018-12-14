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
     * @throws \Nip\Logger\Exception
     */
    public static function create($subject, $file)
    {
        return static::newFileAdder()
            ->setSubject($subject)
            ->setFile($file);
    }

    /**
     * @return FileAdder
     */
    public static function newFileAdder()
    {
        if (function_exists('app')) {
            app(FileAdder::class);
        }
        return new FileAdder;
    }
}