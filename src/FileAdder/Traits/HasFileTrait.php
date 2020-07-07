<?php

namespace ByTIC\MediaLibrary\FileAdder\Traits;

use Nip\Logger\Exception;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Trait HasFileTrait
 * @package ByTIC\MediaLibrary\FileAdder\Traits
 */
trait HasFileTrait
{
    /** @var string|\Symfony\Component\HttpFoundation\File\File */
    protected $file;

    /** @var string */
    protected $pathToFile;

    /**
     * @return string|SymfonyFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getPathToFile(): string
    {
        return $this->pathToFile;
    }

    /**
     * @param string $pathToFile
     */
    public function setPathToFile(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    /**
     * @param $file
     *
     * @throws Exception
     *
     * @return $this
     */
    public function setFile($file)
    {
        if (is_string($file)) {
            $file = new SymfonyFile($file, true);
        }
        if ($file instanceof UploadedFile) {
            return $this->setFileFromUploadedFile($file);
        }
        if ($file instanceof SymfonyFile) {
            return $this->setFileFromSymfonyFile($file);
        }

        throw new Exception('Invalid File');
    }

    /**
     * @param SymfonyFile $file
     *
     * @throws Exception
     *
     * @return $this
     */
    public function setFileFromSymfonyFile($file)
    {
        $this->file = $file;
        $this->setPathToFile($file->getPath() . '/' . $file->getFilename());
        $this->setFileName(pathinfo($file->getFilename(), PATHINFO_BASENAME));
        $this->mediaName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

        return $this;
    }

    /**
     * @param UploadedFile $file
     *
     * @return $this
     */
    public function setFileFromUploadedFile($file)
    {
        $this->file = $file;
        $this->setPathToFile($file->getPath() . '/' . $file->getFilename());
        $this->setFileName($file->getClientOriginalName());
        $this->mediaName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return $this;
    }
}
