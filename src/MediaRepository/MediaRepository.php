<?php

namespace ByTIC\MediaLibrary\MediaRepository;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use Nip\Records\Record;

/**
 * Class MediaRepository
 * @package ByTIC\MediaLibrary\MediaRepository
 */
class MediaRepository
{
    use Traits\NewCollectionTrait;

    protected $loader;

    /**
     * @var \ByTIC\MediaLibrary\Collections\Collection[]
     */
    protected $collections;

    /**
     * @var Record|HasMediaTrait
     */
    protected $record;

    /**
     * @return Record|HasMediaTrait
     */
    public function getRecord(): Record
    {
        return $this->record;
    }

    /**
     * @param Record|HasMediaTrait $record
     */
    public function setRecord(Record $record)
    {
        $this->record = $record;
    }

    /**
     * @param string $collectionName
     * @param array $filter
     * @return Collection
     */
    public function getFilteredCollection(string $collectionName, $filter = []): Collection
    {
        return $this->applyFilterToCollection($this->getCollection($collectionName), $filter);
    }

    /**
     * Apply given filters on media.
     *
     * @param Collection $collection
     * @param array|callable $filter
     *
     * @return Collection
     */
    protected function applyFilterToCollection(Collection $collection, $filter): Collection
    {
        return $collection->filter($filter);
    }

}