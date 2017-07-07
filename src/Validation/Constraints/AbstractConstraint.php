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

    /**
     * @var bool
     */
    protected $init = false;

    /**
     * @var string
     */
    protected $name = null;

    public function init()
    {
        if ($this->init === true) {
            return;
        }
        $this->doInit();
        $this->init = true;
    }

    protected function doInit()
    {
        $this->initVariablesFromConfig();
    }

    protected function initVariablesFromConfig()
    {
        $configKey = 'media-library.contraints.' . $this->getName();
        if (config()->has($configKey)) {
            $variables = config()->get($configKey);
            $this->applyVariables($variables);
        }
    }

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