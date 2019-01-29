<?php

namespace ByTIC\MediaLibrary\FileAdder;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class FileAdderFactory.
 */
class FileAdderFactory
{
    /**
     * @param HasMediaTrait                                      $subject
     * @param string|\Symfony\Component\HttpFoundation\File\File $file
     *
     * @throws \Nip\Logger\Exception
     *
     * @return FileAdder
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

        return new FileAdder();
    }
}
