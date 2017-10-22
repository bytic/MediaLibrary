<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy;

use ByTIC\MediaLibrary\FileAdder\FileAdder;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class GenericStrategy
 * @package ByTIC\MediaLibrary\Collections\UploadStrategy
 */
class GenericStrategy extends AbstractStrategy
{
    /**
     * @param FileAdder $fileAdder
     * @return string
     */
    public static function makeFileName($fileAdder)
    {
        $file = $fileAdder->getFile();

        if ($file instanceof UploadedFile) {
            return date('Y-m-d-') . md5(md5_file($file->getRealPath()) . time()) . '.' . $file->getClientOriginalExtension();
        }
        if ($file instanceof SymfonyFile) {
            return date('Y-m-d-') . md5(md5_file($file->getRealPath()) . time()) . '.' . $file->getExtension();
        }
        if (is_string($file)) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            return date('Y-m-d-') . md5($file . time()) . '.' . $extension;
        }

        throw new \RuntimeException(__METHOD__ . ' needs a UploadedFile|SplFileInfo|string instance or a file path string');
    }
}