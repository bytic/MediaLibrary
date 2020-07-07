<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy;

/**
 * Class OriginalNameStrategy.
 */
class OriginalNameStrategy extends AbstractStrategy
{
    /**
     * @param $path
     * @param $extension
     *
     * @return string
     */
    public static function transformFileName($path, $extension)
    {
        $name = pathinfo($path, PATHINFO_FILENAME);

        return $name . '.' . $extension;
    }
}
