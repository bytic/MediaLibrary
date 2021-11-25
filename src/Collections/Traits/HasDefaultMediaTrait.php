<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Support\MediaModels;
use Nip\Records\Record;

/**
 * Trait HasDefaultMediaTrait.
 *
 * @method HasMediaTrait|Record getRecord
 */
trait HasDefaultMediaTrait
{
    /**
     * @var null|Media
     */
    protected $defaultMedia = null;

    /**
     * @param Media $media
     */
    public function setDefaultMedia($media)
    {
        $this->defaultMedia = $media;
    }

    /**
     * @param $mediaName
     *
     * @return mixed
     */
    public function persistDefaultMediaFromName($mediaName)
    {
        $media = $this->get($mediaName, null);
        if ($media) {
            $this->setDefaultMedia($media);

            return $this->persistDefaultMedia();
        }
    }


    public function persistDefaultMedia()
    {
        $media = $this->getDefaultMedia();

        if ($media->getFile()->exists()) {
            if (method_exists($this->getRecord(), 'persistDefaultMedia')) {
                return $this->getRecord()->persistDefaultMedia($this, $media);
            }

            $propertiesRecord = MediaModels::properties()->forCollection($this);
            $propertiesRecord->defaultMedia($media->getName());
        }
    }

    /**
     * @return Media|null
     */
    public function getDefaultMedia()
    {
        if ($this->defaultMedia === null) {
            $this->initDefaultMedia();
        }

        return $this->defaultMedia;
    }

    protected function initDefaultMedia()
    {
        $this->setDefaultMedia($this->generateDefaultMedia());
    }

    /**
     * @return Media
     */
    public function generateDefaultMedia()
    {
        $propertiesRecord = MediaModels::properties()->forCollection($this);
        if ($propertiesRecord) {
            $defaultMedia = $propertiesRecord->defaultMedia();
            if ($defaultMedia && $this->has($defaultMedia)) {
                return $this->get($defaultMedia);
            }
        }

        if (count($this->items)) {
            return reset($this->items);
        }

        return $this->compileDefaultMedia();
    }

    /**
     * @return Media
     */
    protected function compileDefaultMedia()
    {
        $media = $this->newMedia();

        return $media;
    }

    /**
     * @return string
     */
    public function getDefaultMediaUrl()
    {
        if (method_exists($this->getRecord(), 'getDefaultMediaUrl')) {
            return $this->getRecord()->getDefaultMediaUrl($this);
        }

        if (method_exists($this->getRecord()->getManager(), 'getDefaultMediaUrl')) {
            return $this->getRecord()->getManager()->getDefaultMediaUrl($this);
        }

        return $this->getDefaultMediaGenericUrl();
    }

    /**
     * @return string
     */
    public function getDefaultMediaGenericUrl()
    {
        return \asset('/images/'
            . $this->getRecord()->getManager()->getTable() . '/'
            . $this->getDefaultFileName());
    }

    /**
     * @return string
     */
    public function getDefaultFileName()
    {
        $name = inflector()->singularize($this->getName());
        $extension = $this->getName() == 'logos' ? 'png' : 'jpg';

        return $name . '.' . $extension;
    }
}
