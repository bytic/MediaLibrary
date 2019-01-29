<?php

namespace ByTIC\MediaLibrary\MediaRepository\Traits;

use ByTIC\MediaLibrary\Collections\Collection;

/**
 * Trait NewCollectionTrait.
 */
trait NewCollectionTrait
{
    /**
     * @param string $collectionName
     *
     * @return Collection
     */
    public function getCollection(string $collectionName): Collection
    {
        if (!isset($this->collections[$collectionName])) {
            $this->initCollection($collectionName);
        }

        return $this->collections[$collectionName];
    }

    /**
     * @param string $collectionName
     */
    protected function initCollection(string $collectionName)
    {
        $collection = $this->getNewCollection($collectionName);
        $this->prepareCollection($collection);
        $this->addCollection($collection);
    }

    /**
     * @param string $collectionName
     *
     * @return Collection
     */
    protected function getNewCollection(string $collectionName)
    {
        $collection = new Collection();
        $collection->setName($collectionName);
        $collection->setMediaRepository($this);

        return $collection;
    }

    /**
     * @param Collection $collection
     */
    protected function prepareCollection($collection)
    {
        $this->prepareCollectionImages($collection);
        $this->prepareCollectionFiles($collection);
        $collection->loadMedia();
    }

    /**
     * @param Collection $collection
     */
    protected function prepareCollectionImages($collection)
    {
        if (in_array($collection->getName(), ['images', 'covers', 'logos'])) {
            $collection->setMediaType('images');
            $collection->setOriginalPath('full');
        }
    }

    /**
     * @param Collection $collection
     */
    protected function prepareCollectionFiles($collection)
    {
        if (in_array($collection->getName(), ['files'])) {
            $collection->setMediaType('files');
        }
    }

    /**
     * @param Collection $collection
     */
    protected function addCollection(Collection $collection)
    {
        $this->collections[$collection->getName()] = $collection;
    }
}
