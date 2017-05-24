<?php

namespace ByTIC\MediaLibrary\HasMedia;

use Nip\Collection;

/**
 * Class HasMediaTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
class HasMediaTrait
{


    /**
     * Get media collection by its collectionName.
     *
     * @param string $collectionName
     * @param array|callable $filters
     *
     * @return \Nip\Collection
     */
    public function getMedia(string $collectionName = 'default', $filters = []): Collection
    {
        return app(MediaRepository::class)->getCollection($this, $collectionName, $filters);
    }

}