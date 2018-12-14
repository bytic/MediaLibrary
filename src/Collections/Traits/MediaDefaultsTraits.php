<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait MediaDefaultsTraits
 * @package ByTIC\MediaLibrary\Collections\Traits
 */
trait MediaDefaultsTraits
{

    /**
     * @return Media
     */
    public function getDefaultMedia()
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
    public function getDefaultMediaGenericUrl()
    {
        return '/assets/images/'
            .$this->getRecord()->getManager()->getTable().'/'
            .$this->getDefaultFileName();
    }

    /**
     * @return string
     */
    protected function getDefaultFileName()
    {
        $name = inflector()->singularize($this->getName());
        $extension = $this->getName() == 'logos' ? 'png' : 'jpg';

        return $name.'.'.$extension;
    }
}