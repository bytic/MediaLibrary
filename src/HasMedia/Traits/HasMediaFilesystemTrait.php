<?php

namespace ByTIC\MediaLibrary\HasMedia\Traits;

use Nip\Filesystem\FileDisk;
use Nip\Utility\Str;

/**
 * Trait HasMediaFilesystemTrait.
 */
trait HasMediaFilesystemTrait
{
    /**
     * Get the default files disk instance for current model.
     *
     * @return FileDisk
     */
    public function getMediaFilesystemDisk($collection = null)
    {
        return app('filesystem')->disk($this->getMediaFilesystemDiskName($collection));
    }

    /**
     * @return string
     */
    public function getMediaFilesystemDiskName($collection = null)
    {
        $methodBase = 'generateMediaFilesystemDiskName';
        $method = $methodBase. Str::camel($collection);
        if (method_exists($this, $method)) {
            return $this->{$method}($collection);
        }
        if (method_exists($this, $methodBase)) {
            return $this->{$methodBase}($collection);
        }
        return 'public';
    }
}
