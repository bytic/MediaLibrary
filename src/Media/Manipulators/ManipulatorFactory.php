<?php

namespace ByTIC\MediaLibrary\Media\Manipulators;

use ByTIC\MediaLibrary\Media\Manipulators\Images\ImageManipulator;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Class ManipulatorFactory.
 */
class ManipulatorFactory
{
    /**
     * @var AbstractManipulator[]
     */
    protected static $manipulators = null;

    /**
     * @param $media
     *
     * @return AbstractManipulator
     */
    public static function createForMedia(Media $media)
    {
        $manipulators = self::getManipulators();

        foreach ($manipulators as $manipulator) {
            if ($manipulator->canConvert($media)) {
                return $manipulator;
            }
        }

        return self::get('base');
    }

    /**
     * @return AbstractManipulator[]
     */
    public static function getManipulators()
    {
        self::checkManipulators();

        return self::$manipulators;
    }

    /**
     * @param string $class
     *
     * @return AbstractManipulator
     */
    public static function create($class)
    {
        return new $class();
    }

    /**
     * @param string $name
     *
     * @throws \Exception
     *
     * @return AbstractManipulator
     */
    public static function get($name)
    {
        self::checkManipulators();
        if (isset(self::$manipulators[$name])) {
            return self::$manipulators[$name];
        }

        throw new \Exception('Invalid manipulator name');
    }

    protected static function checkManipulators()
    {
        if (self::$manipulators === null) {
            self::initManipulators();
        }
    }

    protected static function initManipulators()
    {
        $classes = [
            'image' => ImageManipulator::class,
            'base'  => BaseManipulator::class,
        ];
        self::$manipulators = [];
        foreach ($classes as $type => $class) {
            self::$manipulators[$type] = self::create($class);
        }
    }
}
