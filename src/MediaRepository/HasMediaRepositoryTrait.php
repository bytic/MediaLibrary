<?php

namespace ByTIC\MediaLibrary\MediaRepository;

/**
 * Trait HasMediaRepositoryTrait.
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
    public function getMediaRepository()
    {
        if ($this->mediaRepository == null) {
            $this->initMediaRepository();
        }

        return $this->mediaRepository;
    }

    /**
     * @param MediaRepository $repository
     *
     * @return void
     */
    public function setMediaRepository($repository)
    {
        $this->mediaRepository = $repository;
    }

    protected function initMediaRepository()
    {
        $mediaRepository = $this->newMediaRepository();
        $mediaRepository = $this->hydrateMediaRepository($mediaRepository);
        $this->setMediaRepository($mediaRepository);
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

    /**
     * @param $mediaRepository
     *
     * @return MediaRepository
     */
    protected function hydrateMediaRepository($mediaRepository)
    {
        return $mediaRepository;
    }
}
