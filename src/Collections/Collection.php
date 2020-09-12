<?php

namespace ByTIC\MediaLibrary\Collections;

use ByTIC\MediaLibrary\Collections\UploadStrategy\Traits\HasStrategyTrait;
use ByTIC\MediaLibrary\Loaders\AbstractLoader;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Validation\Constraints\Traits\HasConstraintTrait;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;
use Nip\Collections\Lazy\AbstractLazyCollection;

/**
 * Class Collection
 * @package ByTIC\MediaLibrary\Collections
 *
 * @method Media get
 */
class Collection extends AbstractLazyCollection
{
    use Traits\HasAcceptsMediaTrait;
    use Traits\LoadMediaTrait;
    use Traits\HasDefaultMediaTrait;
    use Traits\HasRecordTrait;
    use Traits\MediaOperationsTraits;
    use Traits\HasFilesystemTrait;
    use HasValidatorTrait;
    use HasStrategyTrait;
    use HasConstraintTrait;

    /**
     * {@inheritdoc}
     */
    public function __construct($items = [])
    {
        parent::__construct($items);
        $this->initHasAcceptsMedia();
    }

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $originalPath = null;

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
        $this->setContraintName($name);
    }

    /**
     * @return string
     */
    public function getOriginalPath()
    {
        return $this->originalPath;
    }

    /**
     * @param string $originalPath
     */
    public function setOriginalPath(string $originalPath)
    {
        $this->originalPath = $originalPath;
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
     *
     * @return AbstractLoader
     */
    protected function hydrateLoader($loader)
    {
        $loader->setCollection($this);
        $loader->setFilesystem($this->getFilesystem());

        return $loader;
    }
}
