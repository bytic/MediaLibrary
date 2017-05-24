<?php

namespace ByTIC\MediaLibrary\HasMedia;

use ByTIC\MediaLibrary\Loaders\LoaderInterface;

/**
 * Class MediaRepository
 * @package ByTIC\MediaLibrary\HasMedia
 */
class MediaRepository
{
    protected $loader;

    /** @param LoaderInterface $model */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }


    /**
     * Get all media in the collection.
     *
     * @param \Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia $model
     * @param string $collectionName
     * @param array|callable $filter
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCollection(HasMedia $model, string $collectionName, $filter = []): Collection
    {
        return $this->applyFilterToMediaCollection($model->loadMedia($collectionName), $filter);
    }
}