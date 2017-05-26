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
    function getMediaFiles()
    {
        $path = $this->getBasePath();
        $contents = $this->getFilesystem()->listContents($path);
        foreach ($contents as $object) {
//            echo $object['basename'].' is located at'.$object['path'].' and is a '.$object['type'];
        }
    }
}
