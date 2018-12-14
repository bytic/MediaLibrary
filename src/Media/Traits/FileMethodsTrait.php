<?php

namespace ByTIC\MediaLibrary\Media\Traits;

use Exception;
use League\Flysystem\File as FileLeague;
use Nip\Filesystem\File;

/**
 * Trait FileMethodsTrait
 * @package ByTIC\MediaLibrary\Media\Traits
 */
trait FileMethodsTrait
{

    /**
     * @var File|FileLeague
     */
    protected $file;

    /**
     * @return File
     */
    public function getFile()
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
     * @return bool
     */
    public function hasFile()
    {
        return $this->getFile() instanceof File;
    }

    /**
     * @param $path
     * @param $contents
     */
    public function generateFileFromContent($path, $contents)
    {
        $this->getCollection()->getFilesystem()->put(
            $path,
            $contents
        );

        $file = new File($this->getCollection()->getFilesystem(), $path);
        $this->setFile($file);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getFile()->getName();
    }

    /**
     * @return string
     */
    public function read()
    {
        return $this->getFile()->read();
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->getFile()->delete();
    }


    /**
     * Get the path to the original media file.
     *
     * @param string $conversionName
     * @return string
     * @throws Exception
     */
    public function getPath(string $conversionName = ''): string
    {
        if (!$this->hasFile()) {
            throw  new Exception('Error getting path for media with no file');
        }

        $path = $this->getFile()->getPath();

        if ($conversionName) {
            $path = $this->getBasePath()
                . DIRECTORY_SEPARATOR . $conversionName
                . DIRECTORY_SEPARATOR . $this->getName();
        }

        return $path;
    }
}