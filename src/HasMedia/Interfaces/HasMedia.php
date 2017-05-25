<?php

namespace ByTIC\MediaLibrary\HasMedia\Interfaces;

/**
 * Interface HasMedia
 * @package ByTIC\MediaLibrary\HasMedia\Interfaces
 */
interface HasMedia
{

    /**
     * Cache the media on the object.
     *
     * @param string $collectionName
     *
     * @return mixed
     */
    public function loadMedia(string $collectionName);

}