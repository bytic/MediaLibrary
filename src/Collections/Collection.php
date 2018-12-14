<?php

namespace ByTIC\MediaLibrary\Collections;

use ByTIC\MediaLibrary\Collections\Traits\HasRecordTrait;
use ByTIC\MediaLibrary\Collections\Traits\LoadMediaTrait;
use ByTIC\MediaLibrary\Collections\Traits\MediaDefaultsTraits;
use ByTIC\MediaLibrary\Collections\Traits\MediaOperationsTraits;
use ByTIC\MediaLibrary\Validation\Constraints\Traits\HasConstraintTrait;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;

/**
 * Class Collection
 * @package ByTIC\MediaLibrary\Collections
 */
class Collection extends \Nip\Collections\Collection
{
    use LoadMediaTrait;
    use MediaDefaultsTraits;
    use HasRecordTrait;
    use MediaOperationsTraits;
    use HasValidatorTrait;
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
     * @return \Nip\Filesystem\FileDisk
     */
    protected function getFilesystemDisk()
    {
        return $this->getRecord()->getMediaFilesystemDisk();
    }
}
