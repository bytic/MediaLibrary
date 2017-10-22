<?php

namespace ByTIC\MediaLibrary\Validation\Constraints\Traits;

use ByTIC\MediaLibrary\Validation\Constraints\AbstractConstraint;
use ByTIC\MediaLibrary\Validation\Validators\AbstractValidator;


/**
 * Trait HasValidatorTrait
 * @package ByTIC\MediaLibrary\Validation
 */
trait HasConstraintTrait
{
    /**
     * @var null|AbstractConstraint
     */
    protected $constraint = null;

    /**
     * @return AbstractConstraint|null
     */
    public function getConstraint()
    {
        if ($this->constraint === null) {
            $this->initConstraint();
        }
        return $this->constraint;
    }

    /**
     * @param AbstractConstraint|null $constraint
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;
    }

    protected function initConstraint()
    {
        $constraint = $this->generateConstraint();
        $this->setConstraint($constraint);
    }

    /**
     * @return AbstractConstraint
     */
    protected function generateConstraint()
    {
        $constraint = $this->newConstraint();
        $this->hydrateConstraint($constraint);
        return $constraint;
    }

    /**
     * @return AbstractConstraint
     */
    protected function newConstraint()
    {
        $class = $this->getValidator()->getConstraintClassName();
        return new $class();
    }

    /**
     * @return AbstractValidator
     */
    abstract protected function getValidator();

    /**
     * @param AbstractConstraint $constraint
     */
    protected function hydrateConstraint($constraint)
    {
        $contraintName = $this->getContraintName();
        if ($contraintName) {
            $constraint->setName($contraintName);
        }
        $constraint->init();
    }
}