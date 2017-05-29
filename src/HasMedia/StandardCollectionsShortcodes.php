<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait StandardCollectionsShortcodes
 * @package ByTIC\MediaLibrary\HasMedia
 *
 * @method Collection getMedia(string $collectionName = 'default', $filters = []): Collection
 */
trait StandardCollectionsShortcodes
{

    /**
     * @return Media
     */
    public function getImage()
    {
        return $this->getMedia('images')->getDefaultMedia();
    }

}
