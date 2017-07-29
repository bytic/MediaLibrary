<?php

namespace ByTIC\MediaLibrary\Media\Manipulators;

use Nip\Collection;

/**
 * Class BaseManipulator
 * @package ByTIC\MediaLibrary\Media\Manipulator
 */
class BaseManipulator extends AbstractManipulator
{

    /**
     * @return bool
     */
    public function requirementsAreInstalled(): bool
    {
        return true;
    }

    /**
     * @return Collection
     */
    public function supportedExtensions(): Collection
    {
        return new Collection([]);
    }

    /**
     * @return Collection
     */
    public function supportedMimetypes(): Collection
    {
        return new Collection([]);
    }
}
