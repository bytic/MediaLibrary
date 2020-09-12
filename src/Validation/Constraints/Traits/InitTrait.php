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
            $configKey = 'media-library.contraints.' . $name;
            if (config()->has($configKey)) {
                $variables = config()->get($configKey);
                $this->applyVariables($variables);
                return;
            }
        }
    }
}
