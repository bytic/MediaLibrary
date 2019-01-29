<?php

namespace ByTIC\MediaLibrary\HasMedia\Interfaces;

use ByTIC\MediaLibrary\Collections\Collection;

/**
 * Interface HasMedia.
 */
interface HasMedia
{
    /**
     * @param string $collectionName
     * @param array  $filters
     *
     * @return Collection
     */
    public function getMedia(string $collectionName = 'default', $filters = []): Collection;
}
