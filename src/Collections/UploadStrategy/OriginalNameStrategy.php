<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class OriginalNameStrategy
 * @package ByTIC\MediaLibrary\Collections\UploadStrategy
 */
class OriginalNameStrategy extends AbstractStrategy
{
    /**
     * @param $path
     * @param $extension
     * @return string
     */
    public static function transformFileName($path, $extension)
    {
        $name = pathinfo($path, PATHINFO_FILENAME);
        return $name . '.' . $extension;
    }

}