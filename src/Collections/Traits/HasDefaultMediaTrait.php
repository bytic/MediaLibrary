<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use ByTIC\MediaLibrary\Media\Media;
use Nip\Records\Record;

/**
 * Trait HasDefaultMediaTrait
 * @package ByTIC\MediaLibrary\Collections\Traits
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
     * @return mixed
     */
    public function persistDefaultMediaFromName($mediaName)
    {
        $media = $this->get($mediaName,null);
        if ($media) {
            $this->setDefaultMedia($media);
            return $this->persistDefaultMedia();
        }
    }

    /**
     * @return mixed
     */
    public function persistDefaultMedia()
    {
        $media = $this->getDefaultMedia();

        if ($media->getFile()->exists()) {
            if (method_exists($this->getRecord(), 'persistDefaultMedia')) {
                return $this->getRecord()->persistDefaultMedia($this, $media);
            }

            if ($this->getName() == 'images') {
                $this->getRecord()->default_image = $media->getName();
                $this->getRecord()->update();
            }
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
        return '/assets/images/'
            . $this->getRecord()->getManager()->getTable() . '/'
            . $this->getDefaultFileName();
    }

    /**
     * @return string
     */
    protected function getDefaultFileName()
    {
        $name = inflector()->singularize($this->getName());
        $extension = $this->getName() == 'logos' ? 'png' : 'jpg';
        return $name . '.' . $extension;
    }
}