<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait StandardCollectionsShortcodes
 * @package ByTIC\MediaLibrary\HasMedia
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
