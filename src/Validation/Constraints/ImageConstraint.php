<?php

namespace ByTIC\MediaLibrary\Validation\Constraints;

/**
 * Class Image
 * @package ByTIC\MediaLibrary\Validation\Constraints
 */
class ImageConstraint extends FileConstraint
{
    const SIZE_NOT_DETECTED_ERROR = '6d55c3f4-e58e-4fe3-91ee-74b492199956';
    const TOO_WIDE_ERROR = '7f87163d-878f-47f5-99ba-a8eb723a1ab2';
    const TOO_NARROW_ERROR = '9afbd561-4f90-4a27-be62-1780fc43604a';
    const TOO_HIGH_ERROR = '7efae81c-4877-47ba-aa65-d01ccb0d4645';
    const TOO_LOW_ERROR = 'aef0cb6a-c07f-4894-bc08-1781420d7b4c';
    const RATIO_TOO_BIG_ERROR = '70cafca6-168f-41c9-8c8c-4e47a52be643';
    const RATIO_TOO_SMALL_ERROR = '59b8c6ef-bcf2-4ceb-afff-4642ed92f12e';
    const SQUARE_NOT_ALLOWED_ERROR = '5d41425b-facb-47f7-a55a-de9fbe45cb46';
    const LANDSCAPE_NOT_ALLOWED_ERROR = '6f895685-7cf2-4d65-b3da-9029c5581d88';
    const PORTRAIT_NOT_ALLOWED_ERROR = '65608156-77da-4c79-a88c-02ef6d18c782';
    const CORRUPTED_IMAGE_ERROR = '5d4163f3-648f-4e39-87fd-cc5ea7aad2d1';

    // Include the mapping from the base class
    protected static $errorNames = [
        self::NOT_FOUND_ERROR => 'NOT_FOUND_ERROR',
        self::NOT_READABLE_ERROR => 'NOT_READABLE_ERROR',
        self::EMPTY_ERROR => 'EMPTY_ERROR',
        self::TOO_LARGE_ERROR => 'TOO_LARGE_ERROR',
        self::INVALID_MIME_TYPE_ERROR => 'INVALID_MIME_TYPE_ERROR',
        self::SIZE_NOT_DETECTED_ERROR => 'SIZE_NOT_DETECTED_ERROR',
        self::TOO_WIDE_ERROR => 'TOO_WIDE_ERROR',
        self::TOO_NARROW_ERROR => 'TOO_NARROW_ERROR',
        self::TOO_HIGH_ERROR => 'TOO_HIGH_ERROR',
        self::TOO_LOW_ERROR => 'TOO_LOW_ERROR',
        self::RATIO_TOO_BIG_ERROR => 'RATIO_TOO_BIG_ERROR',
        self::RATIO_TOO_SMALL_ERROR => 'RATIO_TOO_SMALL_ERROR',
        self::SQUARE_NOT_ALLOWED_ERROR => 'SQUARE_NOT_ALLOWED_ERROR',
        self::LANDSCAPE_NOT_ALLOWED_ERROR => 'LANDSCAPE_NOT_ALLOWED_ERROR',
        self::PORTRAIT_NOT_ALLOWED_ERROR => 'PORTRAIT_NOT_ALLOWED_ERROR',
        self::CORRUPTED_IMAGE_ERROR => 'CORRUPTED_IMAGE_ERROR',
    ];

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
