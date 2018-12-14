<?php

namespace ByTIC\MediaLibrary\Collections;

use ByTIC\MediaLibrary\Collections\UploadStrategy\Traits\HasStrategyTrait;
use ByTIC\MediaLibrary\Loaders\AbstractLoader;
use ByTIC\MediaLibrary\Validation\Constraints\Traits\HasConstraintTrait;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;

/**
 * Class Collection
 * @package ByTIC\MediaLibrary\Collections
 */
class Collection extends \Nip\Collections\Collection
{
    use Traits\LoadMediaTrait;
    use Traits\HasDefaultMediaTrait;
    use Traits\HasRecordTrait;
    use Traits\MediaOperationsTraits;
    use Traits\HasFilesystemTrait;
    use HasValidatorTrait;
    use HasStrategyTrait;
    use HasConstraintTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $contraintName = null;


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContraintName()
    {
        return $this->contraintName;
    }

    /**
     * @param string $contraintName
     */
    public function setContraintName(string $contraintName)
    {
        $this->contraintName = $contraintName;
    }

    /**
     * @return string
     */
    public function getOriginalPath()
    {
        return 'full';
    }

    /**
     * @return string
     */
    protected function getDefaultConversion()
    {
        return 'default';
    }

    /**
     * @return bool
     */
    protected function hasConversions()
    {
        return true;
    }

    /**
     * @param AbstractLoader $loader
     * @return AbstractLoader
     */
    protected function hydrateLoader($loader)
    {
        $loader->setCollection($this);
        $loader->setFilesystem($this->getFilesystem());
        return $loader;
    }
}
