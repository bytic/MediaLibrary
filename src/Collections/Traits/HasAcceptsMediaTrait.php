<?php

namespace ByTIC\MediaLibrary\Collections\Traits;

use ByTIC\MediaLibrary\Validation\Validators\AbstractValidator;

/**
 * Trait HasAcceptsMediaTrait.
 *
 * @method  getValidator();
 * @method  getConstraint();
 */
trait HasAcceptsMediaTrait
{
    /** @var callable */
    public $acceptsMedia;

    protected function initHasAcceptsMedia()
    {
        if (method_exists($this, 'getValidator')) {
            $this->initHasAcceptsMediaWithValidation();

            return;
        }
        $this->initHasAcceptsMediaEmpty();
    }

    protected function initHasAcceptsMediaWithValidation()
    {
        $this->acceptsMedia(function ($file) {
            /** @var AbstractValidator $validator */
            $validator = $this->getValidator();
            $constraint = $this->getConstraint();

            $violations = $validator->validate($file, $constraint);
            if ($violations->count() < 1) {
                return true;
            }

            return $violations;
        });
    }

    protected function initHasAcceptsMediaEmpty()
    {
        $this->acceptsMedia(function () {
            return true;
        });
    }

    /**
     * @param callable $acceptsFile
     *
     * @return HasAcceptsMediaTrait
     */
    public function acceptsMedia(callable $acceptsFile): self
    {
        $this->acceptsMedia = $acceptsFile;

        return $this;
    }
}
