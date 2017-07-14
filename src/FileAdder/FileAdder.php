<?php

namespace ByTIC\MediaLibrary\FileAdder;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use Nip\Logger\Exception;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileAdder
 * @package ByTIC\MediaLibrary\FileAdder
 */
class FileAdder
{
    /** @var HasMediaTrait subject */
    protected $subject;

    /** @var null|\ByTIC\MediaLibrary\Media\Media */
    protected $media = null;

    /** @var string|\Symfony\Component\HttpFoundation\File\File */
    protected $file;

    /**@var string */
    protected $pathToFile;

    /**@var string */
    protected $mediaName;

    /**@var string */
    protected $fileName;

    /**
     * @return string|SymfonyFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file
     * @return $this
     * @throws Exception
     */
    public function setFile($file)
    {
        $this->file = $file;
        if (is_string($file)) {
            $this->setPathToFile($file);
            $this->setFileName(pathinfo($file, PATHINFO_BASENAME));
            $this->mediaName = pathinfo($file, PATHINFO_FILENAME);
            return $this;
        }
        if ($file instanceof UploadedFile) {
            $this->setPathToFile($file->getPath() . '/' . $file->getFilename());
            $this->setFileName($file->getClientOriginalName());
            $this->mediaName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            return $this;
        }
        if ($file instanceof SymfonyFile) {
            $this->setPathToFile($file->getPath() . '/' . $file->getFilename());
            $this->setFileName(pathinfo($file->getFilename(), PATHINFO_BASENAME));
            $this->mediaName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            return $this;
        }
        throw new Exception("Invalid File");
    }

    /**
     * Set the name of the file that is stored on disk.
     *
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $this->sanitizeFileName($fileName);
        return $this;
    }

    /**
     * @param $fileName
     *
     * @return string
     */
    protected function sanitizeFileName(string $fileName): string
    {
        return str_replace(['#', '/', '\\'], '-', $fileName);
    }

    /**
     * @param $name
     */
    public function toMediaCollection($name)
    {
        $media = $this->getMedia();
        $collection = $this->getSubject()->getMediaRepository()->getCollection($name);
        $media->setCollection($collection);
        $this->copyMediaToFilesystem();
        $this->createMediaConversions();
    }

    /**
     * @return Media|null
     */
    public function getMedia()
    {
        if ($this->media === null) {
            $this->setMedia($this->createMedia());
        }
        return $this->media;
    }

    /**
     * @param Media|null $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return Media
     * @throws Exception
     */
    protected function createMedia()
    {
        if (($this->file instanceof SymfonyFile) === false) {
            throw new Exception("Invalid file in FileAdder Media Library");
        }
        $media = new Media();
        $media->setRecord($this->getSubject());
        return $media;
    }

    /**
     * @return HasMediaTrait
     */
    public function getSubject(): HasMediaTrait
    {
        return $this->subject;
    }

    /**
     * @param HasMediaTrait $subject
     *
     * @return FileAdder
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    protected function copyMediaToFilesystem()
    {
        $media = $this->getMedia();
        $destination = PathGeneratorFactory::create()::getBasePathForMediaOriginal($media);
        $destination .= DIRECTORY_SEPARATOR . $media->getCollection()->getStrategy()::makeFileName($this);

        $file = fopen($this->getPathToFile(), 'r');

        $media->getCollection()->getFilesystem()->put($destination, $file);
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

    protected function createMediaConversions()
    {
    }
}