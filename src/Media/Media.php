<?php

namespace ByTIC\MediaLibrary\Media;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\UrlGenerator\UrlGeneratorFactory;
use Nip\Filesystem\File;
use Nip\Records\Record;
use function Nip\url;

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

    /**
     * @return string
     * @deprecated Use getFullUrl
     */
    public function __toString()
    {
        return $this->getFullUrl();
    }

    /**
     * Get the full url to a original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getFullUrl(string $conversionName = ''): string
    {
        return url()->to($this->getUrl($conversionName));
    }

    /**
     * Get the url to a original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getUrl(string $conversionName = ''): string
    {
        $urlGenerator = UrlGeneratorFactory::createForMedia($this);
        if ($conversionName !== '') {
//            $conversion = ConversionCollection::createForMedia($this)->getByName($conversionName);
//            $urlGenerator->setConversion($conversion);
        }
        return $urlGenerator->getUrl();
    }
}