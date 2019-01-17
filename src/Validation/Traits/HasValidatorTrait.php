<?php

namespace ByTIC\MediaLibrary\Validation\Traits;

use ByTIC\MediaLibrary\Validation\Validators\{
    AbstractValidator, GenericValidator, ImageValidator
};

/**
 * Trait HasValidatorTrait
 * @package ByTIC\MediaLibrary\Validation
 */
trait HasValidatorTrait
{

    /**
     * @return AbstractValidator|null
     */
    public function getValidator()
    {
        $validator = $this->generateValidator();
        return $validator;
    }

    /**
     * @return AbstractValidator
     */
    protected function generateValidator()
    {
        $validator = $this->newValidator();
        $this->hydrateValidator($validator);
        return $validator;
    }

    /**
     * @return AbstractValidator
     */
    protected function newValidator()
    {
        $class = $this->getValidatorClassName();
        return new $class();
    }

    /**
     * @return string
     */
    protected function getValidatorClassName()
    {
        $mediaType = $this->getMediaType();
        switch ($mediaType) {
            case 'images':
                return ImageValidator::class;
        }
        return GenericValidator::class;
    }

    /**
     * @param AbstractValidator $validator
     */
    protected function hydrateValidator($validator)
    {
        $validator->setCollection($this);
    }

    /**
     * @return bool
     */
    public function hasCustomValidator()
    {
        return false;
    }
}
