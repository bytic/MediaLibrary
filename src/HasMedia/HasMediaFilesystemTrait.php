<?php

namespace ByTIC\MediaLibrary\HasMedia;

use Nip\Filesystem\FileDisk;

/**
 * Trait HasMediaFilesystemTrait
 * @package ByTIC\MediaLibrary\HasMedia
 */
trait HasMediaFilesystemTrait
{

    /**
     * Get the default files disk instance for current model
     *
     * @return FileDisk
     */
    public function getMediaFilesystemDisk()
    {
        return app('filesystem')->disk($this->getMediaFilesystemDiskName());
    }

    /**
     * @return string
     */
    public function getMediaFilesystemDiskName()
    {
        return 'public';
    }
}
