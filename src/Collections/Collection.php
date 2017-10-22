<?php

namespace ByTIC\MediaLibrary\Collections;

use ByTIC\MediaLibrary\Collections\UploadStrategy\Traits\HasStrategyTrait;
use ByTIC\MediaLibrary\Loaders\AbstractLoader;
use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Loaders\HasLoaderTrait;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\MediaRepository\HasMediaRepositoryTrait;
use ByTIC\MediaLibrary\Validation\Constraints\Traits\HasConstraintTrait;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;
use Nip\Filesystem\FileDisk;

/**
 * Class Collection
 * @package ByTIC\MediaLibrary\Collections
 */
class Collection extends \Nip\Collection
{
    use HasLoaderTrait;
    use HasMediaRepositoryTrait;
    use HasValidatorTrait;
    use HasStrategyTrait;
    use HasConstraintTrait;
    use Traits\HasDefaultMediaTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $mediaType = 'files';

    /**
     * @var string
     */
    protected $contraintName = null;

    /**
     * @var bool
     */
    protected $mediaLoaded = false;

    /**
     * @var FileDisk
     */
    protected $filesystem = null;

    /**
     * @param $filter
     * @return array|Collection
     *
     * @noinspection PhpUnusedParameterInspection
     */
    public function filter($filter)
    {
        return $this;
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
     * @return mixed
     */
    public function getContraintName()
    {
        return $this->contraintName;
    }

    /**
     * @param string $contraintName
     */
    public function setContraintName(string $contraintName)
    {
        $this->contraintName = $contraintName;
    }

    /**
     * @return string
     */
    public function getOriginalPath()
    {
        return 'full';
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
        $loader->setFilesystem($this->getFilesystem());
        return $loader;
    }

    /**
     * @return FileDisk
     */
    public function getFilesystem()
    {
        if ($this->filesystem == null) {
            $this->initFilesystem();
        }
        return $this->filesystem;
    }

    /**
     * @param mixed $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    protected function initFilesystem()
    {
        $this->setFilesystem($this->generateFilesystem());
    }

    /**
     * @return FileDisk
     */
    protected function generateFilesystem()
    {
        return $this->getMediaRepository()->getRecord()->getMediaFilesystemDisk();
    }

    /**
     * @return mixed
     */
    protected function getLoaderClass()
    {
        return Filesystem::class;
    }
}
