<?php

namespace ByTIC\MediaLibrary\Collections\UploadStrategy\Traits;

use ByTIC\MediaLibrary\Collections\UploadStrategy\AbstractStrategy;
use ByTIC\MediaLibrary\Collections\UploadStrategy\GenericStrategy;
use ByTIC\MediaLibrary\Collections\UploadStrategy\OriginalNameStrategy;

/**
 * Trait HasStrategyTrait
 * @package ByTIC\MediaLibrary\Collections\UploadStrategy\Traits
 */
trait HasStrategyTrait
{
    /**
     * @var null|AbstractStrategy
     */
    protected $strategy = null;

    /**
     * @return AbstractStrategy|null
     */
    public function getStrategy()
    {
        if ($this->strategy === null) {
            $this->initStrategy();
        }
        return $this->strategy;
    }

    /**
     * @param AbstractStrategy|null $strategy
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    protected function initStrategy()
    {
        $this->setStrategy($this->generateStrategy());
    }

    /**
     * @return AbstractStrategy
     */
    protected function generateStrategy()
    {
        $strategy = $this->newStrategy();
        return $strategy;
    }

    /**
     * @return AbstractStrategy
     */
    protected function newStrategy()
    {
        $class = $this->getStrategyClassName();
        return new $class();
    }

    /**
     * @return string
     */
    protected function getStrategyClassName()
    {
        $mediaType = $this->getMediaType();
        switch ($mediaType) {
            case 'images' :
                return GenericStrategy::class;

        }
        return OriginalNameStrategy::class;
    }

}