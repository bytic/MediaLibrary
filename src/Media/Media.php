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
        return $this === $this->getCollection()->getDefaultMedia();
    }
}
