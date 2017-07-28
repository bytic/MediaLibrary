<?php

namespace ByTIC\MediaLibrary\Media\Manipulator;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Class ManipulatorFactory
 * @package ByTIC\MediaLibrary\Media\Manipulator
 */
class ManipulatorFactory
{
    /**
     * @var AbstractManipulator[]
     */
    protected static $manipulators;

    /**
     * @param $media
     * @return AbstractManipulator
     */
    public static function createForMedia(Media $media)
    {
        $manipulators = self::getManipulators();

        foreach ($manipulators as $manipulator) {
            $manipulator->canConvert($media);
        }
        return self::get('base');
    }

    /**
     * @return AbstractManipulator[]
     */
    public static function getManipulators()
    {
        $classes = ['Image'];
        $return = [];
        foreach ($classes as $class) {
            $return[] = self::create($class);
        }
        return $return;
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function create($name)
    {
        $class = 'ByTIC\MediaLibrary\Media\Manipulator\\' . ucfirst($name) . 'Manipulator';
        return new $class();
    }

    /**
     * @param string $name
     * @return AbstractManipulator
     * @throws \Exception
     */
    public static function get($name)
    {
        if (isset(self::$manipulators[$name])) {
            return self::$manipulators[$name];
        }
        if ($name == 'base') {
            self::$manipulators[$name] = new BaseManipulator();
            return self::$manipulators[$name];
        }
        throw new \Exception('Invalid manipulator name');
    }
}
