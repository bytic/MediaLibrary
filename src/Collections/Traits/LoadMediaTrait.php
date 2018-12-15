<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\Loaders\AbstractLoader;
use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Loaders\HasLoaderTrait;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;

/**
 * Trait LoadMediaTrait
 * @package ByTIC\MediaLibrary\Collections\Traits
 */
trait LoadMediaTrait
{
    use HasLoaderTrait;
    use HasMediaRepositoryTrait;

    /**
     * @var string
     */
    protected $mediaType = 'files';

    /**
     * @var bool
     */
    protected $mediaLoaded = false;

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
     * @return Media
     */
    public function newMedia()
    {
        $mediaFile = new Media();
        $mediaFile->setCollection($this);
        $mediaFile->setModel($this->getMediaRepository()->getRecord());

        return $mediaFile;
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
     * @param AbstractLoader $loader
     * @return AbstractLoader
     */
    protected function hydrateLoader($loader)
    {
        $loader->setCollection($this);
        $loader->setFilesystem($this->getFilesystem());

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