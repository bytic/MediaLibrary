<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy;

use ByTIC\MediaLibrary\FileAdder\FileAdder;

/**
 * Class GenericStrategy.
 */
class GenericStrategy extends AbstractStrategy
{
    /**
     * @param FileAdder $fileAdder
     *
     * @return string
     */
    public static function transformFileName($path, $extension)
    {
        return date('Y-m-d-') . md5($path . time()) . '.' . $extension;
    }
}
