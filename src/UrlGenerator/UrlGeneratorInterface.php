<?php

namespace ByTIC\MediaLibrary\UrlGenerator;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Interface UrlGeneratorInterface.
 */
interface UrlGeneratorInterface
{
    /**
     * Get the url for the profile of a media item.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param \ByTIC\MediaLibrary\Media\Media $media
     *
     * @return \ByTIC\MediaLibrary\UrlGenerator\UrlGeneratorInterface
     */
    public function setMedia(Media $media): self;
}
