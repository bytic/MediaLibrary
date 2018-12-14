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
        $basePath = self::getBasePathForMedia($media);
        $originalPath = $media->getCollection()->getOriginalPath();
        if (!empty($originalPath)) {
            $basePath .= DIRECTORY_SEPARATOR . $media->getCollection()->getOriginalPath();
        }
        return $basePath;
    }

    /**
     * @param Media $media
     * @return string
     */
    public static function getBasePathForMedia($media)
    {
        return '/' . $media->getCollection()->getName()
            . '/' . $media->getModel()->getManager()->getTable()
            . '/' . $media->getModel()->getPrimaryKey()
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