<?php

namespace ByTIC\MediaLibrary\PathGenerator;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Class PathGenerator
 * @package ByTIC\MediaLibrary\PathGenerator
 */
class PathGenerator
{

    /**
     * @param Media $media
     * @return string
     */
    public static function getBasePathForMedia($media)
    {
        return '/' . $media->getCollection()->getName() . '/' . $media->getRecord()->getPrimaryKey() . '/';
    }

}