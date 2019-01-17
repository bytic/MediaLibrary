<?php

namespace ByTIC\MediaLibrary\Validation\Constraints;

use Nip\Utility\Traits\NameWorksTrait;

/**
 * Class AbstractConstraint
 * @package ByTIC\MediaLibrary\Validation\Constraints
 */
abstract class AbstractConstraint implements ConstraintInterface
{
    use NameWorksTrait;
    use Traits\InitTrait;

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        if ($this->name === null) {
            $this->initName();
        }
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    protected function initName()
    {
        $this->name = strtolower(str_replace('Constraint', '', $this->getClassFirstName()));
    }

    /**
     * @param $variables
     */
    protected function applyVariables($variables)
    {
        foreach ($variables as $name => $value) {
            $this->{$name} = $value;
        }
    }
}