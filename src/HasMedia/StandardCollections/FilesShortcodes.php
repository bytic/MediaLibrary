<?php

namespace ByTIC\MediaLibrary\HasMedia\StandardCollections;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait StandardCollectionsShortcodes
 * @package ByTIC\MediaLibrary\HasMedia
 *
 * @method Collection getMedia(string $collectionName = 'default', $filters = []): Collection
 */
trait FilesShortcodes
{

    /**
     * @return Collection
     */
    public function getFiles()
    {
        return $this->getMedia('files');
    }
}
