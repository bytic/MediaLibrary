<?php

namespace ByTIC\MediaLibrary\Tests\Validation\Constraints\Traits;

use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Validation\Constraints\ImageConstraint;
use Nip\Config\Config;
use Nip\Container\Container;

/**
 * Class InitTraitTest
 * @package ByTIC\MediaLibrary\Tests\Validation\Constraints\Traits
 */
class InitTraitTest extends AbstractTest
{
    public function test_initVariablesFromConfig()
    {
        $config = \Mockery::mock(Config::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $config->shouldReceive('has')->once()->with('media-library.contraints.covers')->andReturnFalse();
        $config->shouldReceive('has')->once()->with('media-library.contraints.image')->andReturnTrue();
        $config->shouldReceive('get')->once()->with('media-library.contraints.image')->andReturn([]);

        Container::getInstance()->set('config', $config);

        $contraint = new ImageConstraint();
        $contraint->setName('covers');
        $contraint->init();
    }
}
