<?php

namespace ByTIC\MediaLibrary\Loaders;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\PathGenerator\PathGenerator;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use Nip\Filesystem\File;
use Nip\Filesystem\FileDisk;

/**
 * Class AbstractLoader
 * @package ByTIC\MediaLibrary\Loaders
 */
abstract class AbstractLoader implements LoaderInterface
{
    /**
     * @var FileDisk
     */
    protected $filesystem;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @return FileDisk
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param mixed $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Load media for a collection
     */
    public function loadMedia()
    {
        $files = $this->getMediaFiles();

        foreach ($files as $file) {
            $mediaFile = $this->newMedia();
            $mediaFile->setFile($file);
            $this->appendMediaInCollection($mediaFile);
        }
    }

    /**
     * @return File[]
     */
    abstract function getMediaFiles();

    /**
     * @return Media
     */
    protected function newMedia()
    {
        $mediaFile = new Media();
        $mediaFile->setCollection($this->getCollection());
        $mediaFile->setRecord($this->getCollection()->getMediaRepository()->getRecord());
        return $mediaFile;
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
     * @param $media
     */
    protected function appendMediaInCollection($media)
    {
        $this->getCollection()->appendMedia($media);
    }

    /**
     * @return string
     */
    protected function getBasePath()
    {
        $media = $this->newMedia();
        return PathGeneratorFactory::create()::getBasePathForMedia($media);
    }
}
