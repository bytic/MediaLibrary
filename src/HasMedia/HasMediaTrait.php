<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;

/**
 * Trait HasMediaTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaTrait
{
    use HasMediaRepositoryTrait;
    use HasMediaFilesystemTrait;
    use StandardCollectionsShortcodes;

    /**
     * Get media collection by its collectionName.
     *
     * @param string $collectionName
     * @param array|callable $filters
     *
     * @return Collection
     */
    public function getMedia(string $collectionName = 'default', $filters = []): Collection
    {
        return $this->getMediaRepository()->getFilteredCollection($collectionName, $filters);
    }

}