<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;
use Nip\Collection;

/**
 * Trait HasMediaTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaTrait
{
    use HasMediaRepositoryTrait;

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
        return $this->getMediaRepository()->getFilteredCollection($collectionName, $filters);
    }

}