<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

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
}
