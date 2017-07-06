<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\UnexpectedTypeException;
use ByTIC\MediaLibrary\Validation\Constraints\AbstractConstraint;
use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;
use Nip\Utility\Traits\NameWorksTrait;

/**
 * Class ImageValidator
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
abstract class AbstractValidator implements ValidatorInterface
{
    use NameWorksTrait;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var AbstractConstraint|null
     */
    protected $contraint = null;

    /**
     * @param $value
     * @param $constraint
     * @return mixed|void
     */
    public function validate($value, ConstraintInterface $constraint = null)
    {
        $constraint = $constraint ? $constraint : $this->getConstraint();
        $this->isValidContraint($constraint);

        if (!$this->contraintNeedsValidation($constraint)) {
            return;
        }

        $this->doValidation($value, $constraint);
    }

    /**
     * @return AbstractConstraint|null
     */
    public function getConstraint()
    {
        if ($this->contraint == null) {
            $this->initContraint();
        }
        return $this->contraint;
    }

    protected function initContraint()
    {
        $constraint = $this->newContraint();
        $this->setContraint($constraint);
    }

    /**
     * @return AbstractConstraint
     */
    protected function newContraint()
    {
        $class = $this->getContraintClassName();
        return new $class();
    }

    /**
     * @return mixed
     */
    protected function getContraintClassName()
    {
        $className = $this->getClassName();
        $firstName = $this->getClassFirstName();
        $contraintFirstName = str_replace('Validator', 'Constraint', $firstName);
        return str_replace('\Validators\\' . $firstName, '\Contraints\\' . $contraintFirstName, $className);
    }

    /**
     * @param AbstractConstraint|null $contraint
     */
    public function setContraint($contraint)
    {
        $this->contraint = $contraint;
    }

    /**
     * @param AbstractConstraint $constraint
     */
    protected function isValidContraint($constraint)
    {
        $className = $this->getContraintClassName();

        if (!$constraint instanceof $className) {
            throw new UnexpectedTypeException($constraint, $className);
        }
    }

    /**
     * @param ConstraintInterface $constraint
     * @return boolean
     */
    abstract protected function contraintNeedsValidation(ConstraintInterface $constraint): bool;

    /**
     * @param $value
     * @param ConstraintInterface $constraint
     * @return mixed
     */
    abstract protected function doValidation($value, ConstraintInterface $constraint);

    /**
     * @return Collection
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection|HasValidatorTrait $collection
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return AbstractConstraint
     */
    protected function generateContraint()
    {
        $constraint = $this->newContraint();
        $this->hydrateContraint($constraint);
        return $constraint;
    }

    /**
     * @param AbstractConstraint $constraint
     */
    protected function hydrateContraint($constraint)
    {
        $constraint->init();
    }
}