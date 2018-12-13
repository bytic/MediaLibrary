<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\StandardCollections\FilesShortcodes;
use ByTIC\MediaLibrary\HasMedia\StandardCollections\ImageShortcodes;
use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;
use ByTIC\MediaLibrary\MediaRepository\MediaRepository;

/**
 * Trait HasMediaTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaTrait
{
    use HasMediaRepositoryTrait;
    use HasMediaFilesystemTrait;
    use ImageShortcodes;
    use FilesShortcodes;

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