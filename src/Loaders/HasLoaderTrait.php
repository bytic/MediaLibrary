<?php

namespace ByTIC\MediaLibrary\Loaders;

/**
 * Trait HasLoaderTrait
 * @package ByTIC\MediaLibrary\Loaders
 */
trait HasLoaderTrait
{

    /**
     * @var AbstractLoader
     */
    protected $loader = null;

    /**
     * @return AbstractLoader
     */
    public function getLoader(): AbstractLoader
    {
        if ($this->loader == null) {
            $this->initLoader();
        }
        return $this->loader;
    }

    /**
     * @param AbstractLoader $loader
     */
    public function setLoader(AbstractLoader $loader)
    {
        $this->loader = $loader;
    }

    protected function initLoader()
    {
        $loader = $this->newLoader();
        $loader = $this->hydrateLoader($loader);
        $this->setLoader($loader);
    }

    /**
     * @param AbstractLoader $loader
     * @return AbstractLoader
     */
    protected function hydrateLoader($loader)
    {
        return $loader;
    }

    /**
     * @return AbstractLoader
     */
    protected function newLoader() {
        $class = $this->getLoaderClass();
        $loader = new $class();
        return $loader;
    }

    abstract protected function getLoaderClass();
}