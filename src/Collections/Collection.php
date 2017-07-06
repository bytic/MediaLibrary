<?php

namespace ByTIC\MediaLibrary\Collections;

use ByTIC\MediaLibrary\Loaders\AbstractLoader;
use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Loaders\HasLoaderTrait;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;

/**
 * Class Collection
 * @package ByTIC\MediaLibrary\Collections
 */
class Collection extends \Nip\Collection
{
    use HasLoaderTrait;
    use HasMediaRepositoryTrait;
    use HasValidatorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $mediaType = 'files';

    /**
     * @var bool
     */
    protected $mediaLoaded = false;

    /** @noinspection PhpUnusedParameterInspection
     *
     * @param $filter
     * @return array|Collection
     */
    public function filter($filter)
    {
        return $this;
    }

    /**
     * @return Media
     */
    public function getDefaultMedia()
    {
        if (count($this->items)) {
            return reset($this->items);
        }
        return $this->compileDefaultMedia();
    }

    /**
     * @return Media
     */
    protected function compileDefaultMedia()
    {
        $media = $this->newMedia();
        return $media;
    }

    /**
     * @return Media
     */
    public function newMedia()
    {
        $mediaFile = new Media();
        $mediaFile->setCollection($this);
        $mediaFile->setRecord($this->getMediaRepository()->getRecord());
        return $mediaFile;
    }

    /**
     * @return string
     */
    public function getDefaultMediaUrl()
    {
        if (method_exists($this->getRecord(), 'getDefaultMediaUrl')) {
            return $this->getRecord()->getDefaultMediaUrl($this);
        }

        if (method_exists($this->getRecord()->getManager(), 'getDefaultMediaUrl')) {
            return $this->getRecord()->getManager()->getDefaultMediaUrl($this);
        }

        return $this->getDefaultMediaGenericUrl();
    }

    /**
     * @return \ByTIC\MediaLibrary\HasMedia\HasMediaTrait|\Nip\Records\Record
     */
    protected function getRecord()
    {
        return $this->getMediaRepository()->getRecord();
    }

    /**
     * @return string
     */
    public function getDefaultMediaGenericUrl()
    {
        return '/assets/images/'
            . $this->getRecord()->getManager()->getTable() . '/'
            . $this->getDefaultFileName();
    }

    /**
     * @return string
     */
    protected function getDefaultFileName()
    {
        $name = inflector()->singularize($this->getName());
        $extension = $this->getName() == 'logos' ? 'png' : 'jpg';
        return $name . '.' . $extension;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function loadMedia()
    {
        if ($this->isMediaLoaded()) {
            return;
        }

        $this->getLoader()->loadMedia();

        $this->setMediaLoaded(true);
    }

    /**
     * @return bool
     */
    public function isMediaLoaded(): bool
    {
        return $this->mediaLoaded;
    }

    /**
     * @param bool $mediaLoaded
     */
    public function setMediaLoaded(bool $mediaLoaded)
    {
        $this->mediaLoaded = $mediaLoaded;
    }

    /**
     * Append a media object inside the collection
     *
     * @param Media $media
     */
    public function appendMedia(Media $media)
    {
        $this->items[$media->getName()] = $media;
    }

    /**
     * @return mixed
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param mixed $mediaType
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;
    }

    /**
     * @return string
     */
    protected function getDefaultConversion()
    {
        return 'default';
    }

    /**
     * @return bool
     */
    protected function hasConversions()
    {
        return true;
    }

    /**
     * @param AbstractLoader $loader
     * @return AbstractLoader
     */
    protected function hydrateLoader($loader)
    {
        $loader->setCollection($this);
        $loader->setFilesystem($this->getMediaRepository()->getRecord()->getMediaFilesystemDisk());
        return $loader;
    }

    /**
     * @return mixed
     */
    protected function getLoaderClass()
    {
        return Filesystem::class;
    }
}
