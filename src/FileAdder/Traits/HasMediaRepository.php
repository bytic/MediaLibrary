<?php

namespace ByTIC\MediaLibrary\FileAdder\Traits;

use ByTIC\MediaLibrary\Exceptions\RuntimeException;
use ByTIC\MediaLibrary\MediaRepository\MediaRepository;

/**
 * Trait HasMediaRepository
 * @package ByTIC\MediaLibrary\FileAdder\Traits
 */
trait HasMediaRepository
{

    /** @var MediaRepository $repository */
    protected $repository = null;

    /**
     * @return mixed
     */
    public function getMediaRepository()
    {
        if ($this->repository) {
            return $this->repository;
        }

        if ($this->hasSubject()) {
            return $this->getSubject()->getMediaRepository();
        }

        throw new RuntimeException("MediaRepository could not be detected in FileAdder");
    }

    /**
     * @param MediaRepository $repository
     */
    public function setRepository(MediaRepository $repository)
    {
        $this->repository = $repository;
    }
}
