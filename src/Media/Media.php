<?php

namespace ByTIC\MediaLibrary\Media;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use League\Flysystem\File as FileLeague;
use Nip\Filesystem\File;
use Nip\Logger\Exception;
use Nip\Records\Record;
use function Nip\url;

/**
 * Class Media
 * @package ByTIC\MediaLibrary
 */
class Media
{

    /**
     * @var Record
     */
    protected $model;

    /**
     * @var File|FileLeague
     */
    protected $file;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @return Record|HasMediaTrait
     */
    public function getModel(): Record
    {
        return $this->model;
    }

    /**
     * @param Record|HasMediaTrait $record
     */
    public function setModel(Record $record)
    {
        $this->model = $record;
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
    public function getExtension()
    {
        return pathinfo($this->getName(), PATHINFO_EXTENSION);
    }

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

    /**
     * @return string
     */
    public function getBasePath()
    {
        return PathGeneratorFactory::create()::getBasePathForMedia($this);
    }

    /**
     * @return string
     * @deprecated Use getFullUrl
     */
    public function __toString()
    {
        return $this->getFullUrl();
    }

    /**
     * Get the full url to a original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getFullUrl(string $conversionName = ''): string
    {
        return url()->to($this->getUrl($conversionName));
    }

    /**
     * Get the url to a original media file.
     *
     * @param string $conversionName
     *
     * @return string
     */
    public function getUrl(string $conversionName = ''): string
    {
        if ($this->hasFile()) {
            return $this->getFile()->getUrl();
        }
        return $this->getCollection()->getDefaultMediaUrl();
//        $urlGenerator = UrlGeneratorFactory::createForMedia($this);
//        if ($conversionName !== '') {
////            $conversion = ConversionCollection::createForMedia($this)->getByName($conversionName);
////            $urlGenerator->setConversion($conversion);
//        }
//        return $urlGenerator->getUrl();
    }

    /**
     * @return bool
     */
    public function hasFile()
    {
        return $this->getFile() instanceof File;
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this === $this->getCollection()->getDefaultMedia();
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
}