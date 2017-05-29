<?php

namespace ByTIC\MediaLibrary\Collections;

use ByTIC\MediaLibrary\Loaders\AbstractLoader;
use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Loaders\HasLoaderTrait;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;

/**
 * Class Collection
 * @package ByTIC\MediaLibrary\Collections
 */
class Collection extends \Nip\Collection
{
    use HasLoaderTrait;
    use HasMediaRepositoryTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $mediaLoaded = false;

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
        return reset($this->items);
    }

    public function loadMedia()
    {
        if ($this->isMediaLoaded())
            return;

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
