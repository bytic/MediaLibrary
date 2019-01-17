<?php

namespace ByTIC\MediaLibrary\Validation\Validators;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\Exceptions\UnexpectedTypeException;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Validation\Constraints\AbstractConstraint;
use ByTIC\MediaLibrary\Validation\Constraints\ConstraintInterface;
use ByTIC\MediaLibrary\Validation\Traits\HasValidatorTrait;
use ByTIC\MediaLibrary\Validation\Violations\Violation;
use ByTIC\MediaLibrary\Validation\Violations\ViolationsBag;
use Nip\Utility\Traits\NameWorksTrait;

/**
 * Class ImageValidator
 * @package ByTIC\MediaLibrary\Validation\Validators
 */
abstract class AbstractValidator implements ValidatorInterface
{
    use NameWorksTrait;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var mixed
     */
    protected $constraint;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var ViolationsBag
     */
    protected $violations;

    /**
     * @param $value
     * @param $constraint
     * @return ViolationsBag
     */
    public function validate($value, ConstraintInterface $constraint = null)
    {
        $constraint = $constraint ? $constraint : $this->getCollection()->getConstraint();
        $this->setValue($value);
        $this->setConstraint($constraint);
        $this->isValidConstraint();

        $this->violations = new ViolationsBag();

        if ($this->contraintNeedsValidation()) {
            $this->doValidation();
        }

        return $this->violations;
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

    protected function isValidConstraint()
    {
        $className = $this->getConstraintClassName();
        $constraint = $this->getConstraint();

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
     * @return mixed
     */
    public function getConstraint()
    {
        return $this->constraint;
    }

    /**
     * @param mixed $constraint
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;
    }

    /**
     * @return boolean
     */
    abstract protected function contraintNeedsValidation(): bool;

    /**
     * @return void
     */
    abstract protected function doValidation();

    /**
     * @return Media
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param AbstractConstraint $constraint
     * @param $code
     * @param $parameters
     */
    protected function addViolation($constraint, $code, $parameters)
    {
        $violation = new Violation();
        $violation->setCode($code);
        $violation->setMessage($constraint->getErrorMessage($code));
        $violation->setParameters($parameters);

        $this->violations->add(
            $violation
        );
    }
}
