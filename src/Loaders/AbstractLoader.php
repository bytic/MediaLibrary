<?php

namespace ByTIC\MediaLibrary\Loaders;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;
use Nip\Filesystem\File;

/**
 * Class AbstractLoader
 * @package ByTIC\MediaLibrary\Loaders
 */
abstract class AbstractLoader implements LoaderInterface
{
    protected $filesystem;

    /**
     * @var Collection
     */
    protected $collection;

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
     * @return mixed
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

    public function loadMedia()
    {
        $files = $this->getMediaFiles();

        foreach ($files as $file) {
            $mediaFile = $this->newMediaFile();
            $mediaFile->setFile($file);
            $this->appendMediaInCollection($mediaFile);
        }
    }

    /**
     * @return File[]
     */
    abstract function getMediaFiles();

    /**
     * @param $media
     */
    protected function appendMediaInCollection($media)
    {
        $this->getCollection()->appendMedia($media);
    }

    /**
     * @return Media
     */
    protected function newMediaFile()
    {
        $mediaFile = new Media();
        return $mediaFile;
    }
}
