<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class AbstractStrategy
 * @package ByTIC\MediaLibrary\Collections\UploadStrategy
 */
abstract class AbstractStrategy implements AbstractStrategyInterface
{
    /**
     * @param FileAdder $fileAdder
     * @return string
     */
    public static function makeFileName($fileAdder)
    {
        $file = $fileAdder->getFile();

        if ($file instanceof UploadedFile) {
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();
            return static::transformFileName($path, $extension);
        }
        if ($file instanceof SymfonyFile) {
            $path = $file->getRealPath();
            $extension = $file->getExtension();
            return static::transformFileName($path, $extension);
        }
        if (is_string($file)) {
            $path = $file;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            return static::transformFileName($path, $extension);
        }

        throw new \RuntimeException(__METHOD__ . ' needs a UploadedFile|SplFileInfo|string instance or a file path string');
    }

    /**
     * @param $path
     * @param $extension
     * @return string
     */
    abstract public static function transformFileName($path, $extension);
}