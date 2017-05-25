<?php

namespace ByTIC\MediaLibrary\MediaRepository;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Nip\Records\Record;

/**
 * Class MediaRepository
 * @package ByTIC\MediaLibrary\MediaRepository
 */
class MediaRepository
{
    protected $loader;

    /**
     * @var \ByTIC\MediaLibrary\Collections\Collection[]
     */
    protected $collections;

    /**
     * @var Record|HasMedia
     */
    protected $record;

    /**
     * @param Record|HasMedia $record
     */
    public function __construct(Record $record)
    {
        $this->setRecord($record);
    }

    /**
     * @return Record|HasMedia
     */
    public function getRecord(): Record
    {
        return $this->record;
    }

    /**
     * @param Record $record
     */
    public function setRecord(Record $record)
    {
        $this->record = $record;
    }

    /**
     * @param string $collectionName
     * @return Collection
     */
    public function getCollection(string $collectionName): Collection
    {
        if (isset($this->collections[$collectionName])) {
            $this->initCollection($collectionName);
        }
        return $this->collections[$collectionName];
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
     * @param string $collectionName
     */
    protected function initCollection(string $collectionName)
    {
        $collection = $this->getNewCollection($collectionName);
        $this->addCollection($collection);
    }

    /**
     * @param Collection $collection
     */
    protected function addCollection(Collection $collection)
    {
        $this->collections[$collection->getName()] = $collection;
    }

    /**
     * @param string $collectionName
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