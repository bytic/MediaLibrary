<?php

namespace ByTIC\MediaLibrary\PathGenerator;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Class AbstractPathGenerator
 * @package ByTIC\MediaLibrary\PathGenerator
 */
abstract class AbstractPathGenerator
{

    /**
     * @param Media $media
     * @return string
     */
    public static function getBasePathForMediaOriginal($media)
    {
        return self::getBasePathForMedia($media)
            . DIRECTORY_SEPARATOR . $media->getCollection()->getOriginalPath();
    }

    /**
     * @param Media $media
     * @return string
     */
    public static function getBasePathForMedia($media)
    {

        return '/' . $media->getCollection()->getName()
            . '/' . $media->getRecord()->getManager()->getTable()
            . '/' . $media->getRecord()->getPrimaryKey()
            . '/';
    }

    /**
     * @param Media $media
     * @param string $conversionName
     * @return string
     */
    public static function getBasePathForMediaConversion($media, $conversionName)
    {
        return self::getBasePathForMedia($media) . DIRECTORY_SEPARATOR . $conversionName;
    }

}