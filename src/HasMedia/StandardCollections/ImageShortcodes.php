<?php

namespace ByTIC\MediaLibrary\HasMedia\StandardCollections;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait StandardCollectionsShortcodes.
 */
trait ImageShortcodes
{
    /**
     * @return Media
     */
    public function getImage()
    {
        return $this->getMedia('images')->getDefaultMedia();
    }

    /**
     * @return Collection|Media[]
     */
    public function getImages()
    {
        return $this->getMedia('images');
    }

    /**
     * @return Media
     */
    public function getLogo()
    {
        return $this->getMedia('logos')->getDefaultMedia();
    }

    /**
     * @return Collection|Media[]
     */
    public function getLogos()
    {
        return $this->getMedia('logos');
    }

    /**
     * @return bool
     */
    public function hasLogo()
    {
        return $this->getMedia('logos')->count() > 0;
    }

    /**
     * @return Media
     */
    public function getCover()
    {
        return $this->getMedia('covers')->getDefaultMedia();
    }

    /**
     * @return Collection
     */
    public function getCovers()
    {
        return $this->getMedia('covers');
    }

    /**
     * @return bool
     */
    public function hasCover()
    {
        return $this->getMedia('covers')->count() > 0;
    }

    /**
     * @param string $collectionName
     * @param array  $filters
     *
     * @return Collection
     */
    abstract public function getMedia(string $collectionName = 'default', $filters = []): Collection;
}
