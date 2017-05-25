<?php

namespace ByTIC\MediaLibrary\MediaRepository;

/**
 * Trait HasMediaRepositoryTrait
 */
trait HasMediaRepositoryTrait
{
    /**
     * @var null|MediaRepository
     */
    protected $mediaRepository = null;

    /**
     * @return MediaRepository|null
     */
    protected function getMediaRepository()
    {
        if ($this->mediaRepository == null) {
            $this->initMediaRepository();
        }
        return $this->mediaRepository;
    }

    protected function initMediaRepository()
    {

    }

    /**
     * @param MediaRepository $repository
     * @return void
     */
    public function setMediaRepository($repository)
    {
        $this->mediaRepository = $repository;
    }

    /**
     * @return MediaRepository
     */
    protected function newMediaRepository()
    {
       $class = $this->getMediaRepositoryClass();
       $repository = new $class();
       return $repository;
    }

    /**
     * @return string
     */
    protected function getMediaRepositoryClass()
    {
        return MediaRepository::class;
    }
}
