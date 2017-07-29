<?php

namespace ByTIC\MediaLibrary\Media\Manipulators\Images;

use ByTIC\MediaLibrary\Media\Manipulators\AbstractManipulator;
use Nip\Collection;

/**
 * Class ImageManipulator
 * @package ByTIC\MediaLibrary\Media\Manipulator
 */
class ImageManipulator extends AbstractManipulator
{

    /**
     * @return bool
     */
    public function requirementsAreInstalled(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function supportedExtensions(): Collection
    {
        return new Collection(['png', 'jpg', 'jpeg', 'gif']);
    }

    /**
     * @inheritdoc
     */
    public function supportedMimeTypes(): Collection
    {
        return new Collection(['image/jpeg', 'image/gif', 'image/png']);
    }
}