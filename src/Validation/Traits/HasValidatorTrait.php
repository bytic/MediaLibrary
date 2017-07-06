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
     * @var null|AbstractValidator
     */
    protected $validator = null;

    /**
     * @return AbstractValidator|null
     */
    public function getValidator()
    {
        if ($this->validator === null) {
            $this->initValidator();
        }
        return $this->validator;
    }

    /**
     * @param AbstractValidator|null $validator
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    protected function initValidator()
    {
        $validator = $this->generateValidator();
        $this->setValidator($validator);
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