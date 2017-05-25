<?php

namespace ByTIC\MediaLibrary\Media;

use Nip\Filesystem\File;

/**
 * Class Media
 * @package ByTIC\MediaLibrary
 */
class Media
{

    /**
     * @var File
     */
    protected $file;

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getFile()->getPath();
    }

    /**
     * Get the path to the original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getPath(string $conversionName = ''): string
    {
        return '';
    }
}