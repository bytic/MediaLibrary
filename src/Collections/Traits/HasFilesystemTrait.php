<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use Nip\Filesystem\FileDisk;

/**
 * Trait HasFilesystemTrait.
 */
trait HasFilesystemTrait
{
    protected $filesystem;

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

    /**
     * @return mixed
     */
    public function getBasePathForMedia()
    {
        $method = 'getBasePathForMedia';
        $manager = $this->getRecord()->getManager();

        $media = $this->newMedia();

        if (method_exists($manager, $method)) {
            $path = $manager->$method($media);
            if (!empty($path)) {
                return $path;
            }
        }

        return PathGeneratorFactory::create()::$method($media);
    }

    /**
     * @return string
     */
    public function getMediaFilesystemDiskName()
    {
        return $this->getRecord()->getMediaFilesystemDiskName($this->getName());
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
        return $this->getRecord()->getMediaFilesystemDisk($this->getName());
    }
}
