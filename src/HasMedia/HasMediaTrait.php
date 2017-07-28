<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\MediaRepository\MediaRepository;

/**
 * Trait HasMediaTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaTrait
{
    use Traits\HasMediaRepositoryTrait;
    use Traits\HasMediaFilesystemTrait;
    use Traits\StandardCollectionsShortcodes;
    use Traits\HasMediaConversionsTrait;

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


    /**
     * @param MediaRepository $mediaRepository
     * @return MediaRepository
     */
    protected function hydrateMediaRepository($mediaRepository)
    {
        $mediaRepository->setRecord($this);
        return $mediaRepository;
    }
}