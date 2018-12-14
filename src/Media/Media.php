<?php

namespace ByTIC\MediaLibrary\Media;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Collections\Traits\LoadMediaTrait;
use ByTIC\MediaLibrary\Media\Traits\FileMethodsTrait;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use Nip\Records\Record;
use function Nip\url;

/**
 * Class Media
 * @package ByTIC\MediaLibrary
 */
class Media
{
    use FileMethodsTrait;

    /**
     * @var Record
     */
    protected $record;

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
     * @return string
     */
    public function getExtension()
    {
        return pathinfo($this->getName(), PATHINFO_EXTENSION);
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return PathGeneratorFactory::create()::getBasePathForMedia($this);
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
        if ($this->hasFile()) {
            return $this->getFile()->getUrl();
        }
        return $this->getCollection()->getDefaultMediaUrl();
//        $urlGenerator = UrlGeneratorFactory::createForMedia($this);
//        if ($conversionName !== '') {
////            $conversion = ConversionCollection::createForMedia($this)->getByName($conversionName);
////            $urlGenerator->setConversion($conversion);
//        }
//        return $urlGenerator->getUrl();
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection|LoadMediaTrait $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this === $this->getCollection()->getDefaultMedia();
    }
}