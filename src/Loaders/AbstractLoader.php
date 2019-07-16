<?php

namespace ByTIC\MediaLibrary\Loaders;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Collections\Traits\LoadMediaTrait;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use Nip\Filesystem\File;
use Nip\Filesystem\FileDisk;

/**
 * Class AbstractLoader.
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
     * @param FileDisk $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Load media for a collection.
     */
    public function loadMedia()
    {
        $files = $this->getMediaFiles();

        foreach ($files as $file) {
            $mediaFile = $this->getCollection()->newMedia();
            $mediaFile->setFile($file);
            $this->appendMediaInCollection($mediaFile);
        }
    }

    /**
     * @return File[]
     */
    abstract public function getMediaFiles();

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
     * @param $media
     */
    protected function appendMediaInCollection($media)
    {
        $this->getCollection()->appendMediaFromLoader($media, $this);
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->getCollection()->getBasePathForMedia();
    }
}
