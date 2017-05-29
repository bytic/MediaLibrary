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
    public static function getBasePathForMedia($media)
    {

        return '/' . $media->getCollection()->getName()
            . '/' . $media->getRecord()->getManager()->getTable()
            . '/' . $media->getRecord()->getPrimaryKey()
            . '/';
    }

}