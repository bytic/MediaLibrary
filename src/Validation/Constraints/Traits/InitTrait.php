<?php

namespace ByTIC\MediaLibrary\Validation\Constraints\Traits;

/**
 * Trait InitTrait.
 */
trait InitTrait
{
    /**
     * @var bool
     */
    protected $init = false;

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
        if (!function_exists('config')
            || !function_exists('app')
            || !app()->has('config')) {
            return;
        }

        $tries = [$this->getName(), $this->generateName()];
        foreach ($tries as $name) {
            $configKey = 'contraints.' . $name;
            if (\ByTIC\MediaLibrary\Utility\PackageConfig::has($configKey)) {
                $variables = \ByTIC\MediaLibrary\Utility\PackageConfig::constraints($name);
                $this->applyVariables($variables);
                return;
            }
        }
    }
}
