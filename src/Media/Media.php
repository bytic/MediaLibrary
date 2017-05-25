<?php

namespace ByTIC\MediaLibrary\Media;

use ByTIC\MediaLibrary\Collections\Collection;
use Nip\Filesystem\File;
use Nip\Records\Record;

/**
 * Class Media
 * @package ByTIC\MediaLibrary
 */
class Media
{

    /**
     * @var Record
     */
    protected $record;

    /**
     * @var File
     */
    protected $file;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @return Record
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
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getFile()->getPath();
    }

    /**
     * Get the path to the original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getPath(string $conversionName = ''): string
    {
        return '';
    }
}