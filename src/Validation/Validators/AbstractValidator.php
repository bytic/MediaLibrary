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
     * @param $value
     * @param $constraint
     * @return mixed|void
     */
    public function validate($value, ConstraintInterface $constraint = null)
    {
        $constraint = $constraint ? $constraint : $this->getCollection()->getConstraint();
        $this->isValidConstraint($constraint);

        if (!$this->contraintNeedsValidation($constraint)) {
            return;
        }

        $this->doValidation($value, $constraint);
    }

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
     * @param AbstractConstraint $constraint
     */
    protected function isValidConstraint($constraint)
    {
        $className = $this->getConstraintClassName();

        if (!$constraint instanceof $className) {
            throw new UnexpectedTypeException($constraint, $className);
        }
    }

    /**
     * @return mixed
     */
    public function getConstraintClassName()
    {
        $className = $this->getClassName();
        $firstName = $this->getClassFirstName();
        $contraintFirstName = str_replace('Validator', 'Constraint', $firstName);
        return str_replace('\Validators\\' . $firstName, '\Constraints\\' . $contraintFirstName, $className);
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
}
