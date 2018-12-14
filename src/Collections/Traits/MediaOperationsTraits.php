<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait MediaOperationsTraits
 * @package ByTIC\MediaLibrary\Collections\Traits
 */
trait MediaOperationsTraits
{

    /** @noinspection PhpUnusedParameterInspection
     *
     * @param $filter
     * @return MediaOperationsTraits|Collection|Media[]
     */
    public function filter($filter)
    {
        return $this;
    }

    /**
     * @param string $key
     */
    public function deleteMediaByKey($key)
    {
        $this->get($key)->delete();
        $this->unset($key);
    }

    public function delete()
    {
        foreach ($this as $key => $file) {
            /** @var Media $file */
            $file->delete();
            $this->unset($key);
        }
        if (isset($file)) {
            $directory = dirname($file);
            $this->deleteDirIfEmpty($directory);
        }
    }

    /**
     * @param $directory
     */
    protected function deleteDirIfEmpty($directory)
    {
        $contents = $this->getFilesystemDisk()->listContents($directory);
        if (empty($contents)) {
            $this->getFilesystemDisk()->deleteDir($directory);
        }
    }
}