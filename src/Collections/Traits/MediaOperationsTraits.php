<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait MediaOperationsTraits.
 */
trait MediaOperationsTraits
{
    /** @inheritDoc
     */
    public function filter(callable $callback = null)
    {
        $filtered = parent::filter($callback);
        $filtered->rehydrateFromSibling($this);
        return $filtered;
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
            /* @var Media $file */
            $file->delete();
            $this->unset($key);
        }
        if (isset($file)) {
            $directory = dirname($file->getPath());
            $this->deleteDirIfEmpty($directory);
        }
    }

    /**
     * @param $directory
     */
    protected function deleteDirIfEmpty($directory)
    {
        $contents = $this->getFilesystem()->listContents($directory);
        if (empty($contents)) {
            $this->getFilesystem()->deleteDir($directory);
        }
    }

    /**
     * @param static $sibling
     */
    protected function rehydrateFromSibling($sibling)
    {
        $this->setName($sibling->getName());
        $this->setMediaRepository($sibling->getMediaRepository());
        $this->setMediaType($sibling->getMediaType());
    }
}
