<?php

namespace ByTIC\MediaLibrary\Media;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Collections\Traits\LoadMediaTrait;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\PathGenerator\PathGeneratorFactory;
use Nip\Records\Record;
use function Nip\url;

/**
 * Class Media.
 */
class Media
{
    use Traits\UrlMethodsTrait;
    use Traits\FileMethodsTrait;
    use Traits\HasConversionsTrait;

    /**
     * @var Record
     */
    protected $model;

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
    public function getExtension()
    {
        return pathinfo($this->getName(), PATHINFO_EXTENSION);
    }

    /**
     * @param string $conversionName
     * @return string
     */
    public function getBasePath(string $conversionName = '')
    {
        $path = PathGeneratorFactory::create()::getBasePathForMedia($this);
        if ($conversionName) {
            $path = $path . DIRECTORY_SEPARATOR . $conversionName;
        }
        return $path;
    }

    /**
     * @return string
     *
     * @deprecated Use getFullUrl
     */
    public function __toString()
    {
        return $this->getFullUrl();
    }

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection|LoadMediaTrait $collection
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
        return $this->getPath() === $this->getCollection()->getDefaultMedia()->getPath();
    }
}
