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
     * @return Collection|Media[]
     * @deprecated Use getFiles
     */
    public function findFiles()
    {
        return $this->getFiles();
    }

    /**
     * @return Collection|Media[]
     */
    public function getFiles()
    {
        return $this->getMedia('files');
    }
}
