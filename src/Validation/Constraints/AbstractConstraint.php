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
    protected $type;

    public function init()
    {
        if ($this->init === true) {
            return;
        }
        $this->doInit();
        $this->type = strtolower(str_replace('Contraint', '', $this->getClassFirstName()));
        $this->init = true;
    }

    protected function doInit()
    {
        $this->initVariablesFromConfig();
    }

    protected function initVariablesFromConfig()
    {
        $configKey = 'media-library.contraints.' . $this->getType();
        if (config()->has($configKey)) {
            $variables = config()->get($configKey);
            $this->applyVariables($variables);
        }
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
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