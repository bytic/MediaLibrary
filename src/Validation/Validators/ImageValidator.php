<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;
use ByTIC\MediaLibrary\Validation\Constraints\ImageConstraint;
use Nip\Logger\Exception;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class ImageValidator
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
class ImageValidator extends AbstractValidator
{

    /**
     * @return boolean
     */
    protected function contraintNeedsValidation(): bool
    {
        $constraint = $this->getConstraint();

        if (null === $constraint->minWidth && null === $constraint->maxWidth
            && null === $constraint->minHeight && null === $constraint->maxHeight
            && null === $constraint->minPixels && null === $constraint->maxPixels
            && null === $constraint->minRatio && null === $constraint->maxRatio
            && $constraint->allowSquare && $constraint->allowLandscape && $constraint->allowPortrait
            && !$constraint->detectCorrupted
        ) {
            return false;
        }
        return true;
    }

    /**
     * @param File $value
     * @param ConstraintInterface|ImageConstraint $constraint
     * @return mixed
     * @throws Exception
     */
    protected function doValidation()
    {
        $size = @getimagesize($this->getValue());

        if (empty($size) || ($size[0] === 0) || ($size[1] === 0)) {
            $this->addViolation($constraint, ImageConstraint::SIZE_NOT_DETECTED_ERROR, []);
            return;
        }

        $width = $size[0];
        $height = $size[1];

        if ($constraint->minWidth) {
            if (!ctype_digit((string)$constraint->minWidth)) {
                throw new Exception(sprintf('"%s" is not a valid minimum width',
                    $constraint->minWidth));
            }
            if ($width < $constraint->minWidth) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::TOO_NARROW_ERROR,
                    ['width' => $width, 'min_width' => $constraint->minWidth]
                );
                return;
            }
        }

        if ($constraint->maxWidth) {
            if (!ctype_digit((string)$constraint->maxWidth)) {
                throw new Exception(sprintf('"%s" is not a valid maximum width',
                    $constraint->maxWidth));
            }
            if ($width > $constraint->maxWidth) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::TOO_WIDE_ERROR,
                    ['width' => $width, 'max_width' => $constraint->maxWidth]
                );
                return;
            }
        }
        if ($constraint->minHeight) {
            if (!ctype_digit((string)$constraint->minHeight)) {
                throw new Exception(sprintf('"%s" is not a valid minimum height',
                    $constraint->minHeight));
            }
            if ($height < $constraint->minHeight) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::TOO_LOW_ERROR,
                    ['height' => $height, 'min_height' => $constraint->minHeight]
                );
                return;
            }
        }
        if ($constraint->maxHeight) {
            if (!ctype_digit((string)$constraint->maxHeight)) {
                throw new Exception(sprintf('"%s" is not a valid maximum height',
                    $constraint->maxHeight));
            }
            if ($height > $constraint->maxHeight) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::TOO_HIGH_ERROR,
                    ['height' => $height, 'max_height' => $constraint->maxHeight]
                );
            }
        }
        $ratio = round($width / $height, 2);
        if (null !== $constraint->minRatio) {
            if (!is_numeric((string)$constraint->minRatio)) {
                throw new Exception(sprintf('"%s" is not a valid minimum ratio',
                    $constraint->minRatio));
            }
            if ($ratio < $constraint->minRatio) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::RATIO_TOO_SMALL_ERROR,
                    ['ratio' => $ratio, 'minRatio' => $constraint->minRatio]
                );
            }
        }
        if (null !== $constraint->maxRatio) {
            if (!is_numeric((string)$constraint->maxRatio)) {
                throw new Exception(sprintf('"%s" is not a valid maximum ratio',
                    $constraint->maxRatio));
            }
            if ($ratio > $constraint->maxRatio) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::RATIO_TOO_BIG_ERROR,
                    ['ratio' => $ratio, 'max_ratio' => $constraint->maxRatio]
                );
            }
        }

        $this->validateCorruptedFile($constraint, $value);
    }

    /**
     * @param ImageConstraint $constraint
     * @param File $value
     * @return bool
     * @throws Exception
     */
    protected function validateCorruptedFile($constraint, $value)
    {
        if ($constraint->detectCorrupted) {
            if (!function_exists('imagecreatefromstring')) {
                throw new Exception('Corrupted images detection requires installed and enabled GD extension');
            }
            $resource = @imagecreatefromstring(file_get_contents($value));
            if (false === $resource) {
                $this->addViolation(
                    $constraint,
                    ImageConstraint::CORRUPTED_IMAGE_ERROR,
                    []
                );
            }
            imagedestroy($resource);
        }
        return true;
    }

    /**
     * @param ImageConstraint $constraint
     * @param File $value
     * @return bool
     */
    protected function validateOrientation($constraint, $value)
    {
        if (!$constraint->allowSquare && $width == $height) {
            $this->addViolation(
                $constraint,
                ImageConstraint::SQUARE_NOT_ALLOWED_ERROR,
                ['width' => $width, 'height' => $height]
            );
        }
        if (!$constraint->allowLandscape && $width > $height) {
            $this->addViolation(
                $constraint,
                ImageConstraint::LANDSCAPE_NOT_ALLOWED_ERROR,
                ['width' => $width, 'height' => $height]
            );
        }
        if (!$constraint->allowPortrait && $width < $height) {
            $this->addViolation(
                $constraint,
                ImageConstraint::PORTRAIT_NOT_ALLOWED_ERROR,
                ['width' => $width, 'height' => $height]
            );
        }
    }

}