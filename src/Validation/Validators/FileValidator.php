<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Validation\Constraints\FileConstraint;
use ByTIC\MediaLibrary\Validation\Constraints\ImageConstraint;
use Nip\Logger\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileValidator.
 */
class FileValidator extends AbstractValidator
{
    public const KB_BYTES = 1000;
    public const MB_BYTES = 1000000;
    public const KIB_BYTES = 1024;
    public const MIB_BYTES = 1048576;

    private static $suffices = [
        1               => 'bytes',
        self::KB_BYTES  => 'kB',
        self::MB_BYTES  => 'MB',
        self::KIB_BYTES => 'KiB',
        self::MIB_BYTES => 'MiB',
    ];

    /**
     * @return bool
     */
    protected function contraintNeedsValidation(): bool
    {
        $constraint = $this->getConstraint();

        if (null === $constraint->mimeTypes && null === $constraint->maxSize) {
            return false;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    protected function doValidation()
    {
        $this->validateMimeType();
    }

    /**
     * @return void
     */
    protected function validateMimeType()
    {
        $constraint = $this->getConstraint();

        if ($constraint->mimeTypes) {
            $mimeTypes = (array) $constraint->mimeTypes;
            $mime = $this->determineMime();
            foreach ($mimeTypes as $mimeType) {
                if ($mimeType === $mime) {
                    return;
                }
                if ($discrete = strstr($mimeType, '/*', true)) {
                    if (strstr($mime, '/', true) === $discrete) {
                        return;
                    }
                }
            }
            $this->addViolation($constraint, FileConstraint::INVALID_MIME_TYPE_ERROR, []);
        }
    }

    /**
     * @return string|null
     */
    protected function determineMime()
    {
        $file = $this->getValue();
        if ($file instanceof UploadedFile) {
            return $file->getClientMimeType();
        }
    }

    /**
     * @param $width
     * @param $height
     */
    protected function validateOrientation($width, $height)
    {
        $constraint = $this->getConstraint();

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
