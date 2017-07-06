<?php

namespace ByTIC\MediaLibrary\Validation\Constraints;

/**
 * Class Image
 * @package ByTIC\MediaLibrary\Validation\Constraints
 */
class ImageConstraint extends FileConstraint
{

    /**
     * @var string
     */
    public $mimeTypes = 'image/*';

    /**
     * @var int
     */
    public $minWidth;
    /**
     * @var int
     */
    public $maxWidth;

    /**
     * @var int
     */
    public $maxHeight;
    /**
     * @var int
     */
    public $minHeight;

    /**
     * @var int
     */
    public $maxRatio;
    /**
     * @var int
     */
    public $minRatio;

    /**
     * @var int
     */
    public $minPixels;
    /**
     * @var int
     */
    public $maxPixels;

    /**
     * @var bool
     */
    public $allowSquare = true;
    /**
     * @var bool
     */
    public $allowLandscape = true;
    /**
     * @var bool
     */
    public $allowPortrait = true;

    /**
     * @var bool
     */
    public $detectCorrupted = false;

}
