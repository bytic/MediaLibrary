<?php

namespace ByTIC\MediaLibrary\Loaders;

use Nip\Filesystem\File;

/**
 * Class Filesystem
 * @package ByTIC\MediaLibrary\Loaders
 */
class Filesystem extends AbstractLoader
{

    /**
     * @return File[]
     */
    public function getMediaFiles()
    {
        $path = $this->getBasePath();
        $contents = $this->getFilesystem()->listContents($path);
        $directories = [];
        $files = [];
        foreach ($contents as $object) {
            if ($object['type'] == 'dir') {
                $directories[] = $object;
            } else {
                $files[] = $object;
            }
        }
        if (count($directories) > 0) {
            return $this->scanDirectoryContents($directories[0]['path']);
        } elseif (count($files)) {
            return $this->hydrateFileContents($files);
        }
        return [];
    }

    /**
     * @param $path
     * @return File[]
     */
    protected function scanDirectoryContents($path)
    {
        $contents = $this->getFilesystem()->listContents($path);
        return $this->hydrateFileContents($contents);
    }

    /**
     * @param $contents
     * @return File[]
     */
    protected function hydrateFileContents($contents)
    {
        $files = [];
        foreach ($contents as $object) {
            if ($object['type'] == 'file') {
                $files[] = new File($this->getFilesystem(), $object['path']);
            }
        }
        return $files;
    }
}
