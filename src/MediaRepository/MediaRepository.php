<?php

namespace ByTIC\MediaLibrary\MediaRepository;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\Media\Media;
use Closure;
use Nip\Records\Record;
use Nip\Utility\Arr;

/**
 * Class MediaRepository.
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
     * @param array  $filter
     *
     * @return Collection
     */
    public function getFilteredCollection(string $collectionName, $filter = []): Collection
    {
        return $this->applyFilterToCollection($this->getCollection($collectionName), $filter);
    }

    /**
     * Apply given filters on media.
     *
     * @param Collection     $collection
     * @param array|callable $filter
     *
     * @return Collection
     */
    protected function applyFilterToCollection(Collection $collection, $filter): Collection
    {
        if (is_array($filter)) {
            $filter = $this->getDefaultFilterFunction($filter);
        }

        return $collection->filter($filter);
    }

    protected function getDefaultFilterFunction(array $filters): Closure
    {
        return function (Media $media) use ($filters) {
            foreach ($filters as $property => $value) {
                if (! Arr::has($media->custom_properties, $property)) {
                    return false;
                }

                if (Arr::get($media->custom_properties, $property) !== $value) {
                    return false;
                }
            }

            return true;
        };
    }
}
