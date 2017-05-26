<?php

namespace ByTIC\MediaLibrary\UrlGenerator;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Class UrlGeneratorFactory
 * @package ByTIC\MediaLibrary\UrlGenerator
 */
class UrlGeneratorFactory
{
    /**
     * @param Media $media
     * @return UrlGeneratorInterface
     */
    public static function createForMedia(Media $media): UrlGeneratorInterface
    {
    }

}