<?php

namespace ByTIC\MediaLibrary\Models\MediaProperties;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\HasMediaTrait;
use Nip\Records\Record;

/**
 * Class MediaProperty
 * @package ByTIC\MediaLibrary\Models\MediaRecords
 *
 * @property string $model
 * @property int $model_id
 * @property string $collection_name
 * @property string $custom_properties
 *
 * @method HasMediaTrait|Record getModel
 */
class MediaProperty extends Record
{
    /**
     * @var null|array
     */
    protected $customPropertiesArray = null;

    /**
     * @param Record $model
     */
    public function populateFromModel(Record $model)
    {
        $this->model = $model->getManager()->getMorphName();
        $this->model_id = $model->getPrimaryKey();
    }

    /**
     * @param Collection|string $collection
     */
    public function populateFromCollection($collection)
    {
        $name = is_object($collection) ? $collection->getName() : $collection;
        $this->collection_name = $name;
    }

    /**
     * @return array
     */
    public function getCustomProperties()
    {
        $this->checkCustomProperties();
        return $this->customPropertiesArray;
    }

    protected function checkCustomProperties()
    {
        if ($this->customPropertiesArray == null) {
            $this->initCustomProperties();
        }
    }


    public function initCustomProperties()
    {
        $properties = json_decode($this->getAttributeFromArray('custom_properties'), true);
        $properties = (is_array($properties)) ? $properties : [];
        $this->customPropertiesArray = $properties;
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function getCustomProperty($name, $default = null)
    {
        $this->checkCustomProperties();
        return isset($this->customPropertiesArray[$name]) ? $this->customPropertiesArray[$name] : $default;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setCustomPropery($name, $value)
    {
        $this->checkCustomProperties();
        $this->customPropertiesArray[$name] = $value;
        $this->setCustomPropertiesAttribute($this->getCustomProperties());
    }

    /**
     * @param bool $value
     */
    public function saveDbLoaded($value)
    {
        $this->dbLoaded($value);
        $this->save();
    }

    /**
     * @param bool|null $value
     * @return bool
     */
    public function dbLoaded($value = null)
    {
        if ($value == null) {
            return $this->getCustomProperty('dbLoaded', false);
        }
        $value = ($value == true);
        $this->setCustomPropery('dbLoaded', $value);
        return $value;
    }

    /**
     * @param null $value
     * @return mixed|null
     */
    public function defaultMedia($value = null)
    {
        if ($value == null) {
            $model = $this->getModel();
            $default = $model ? $model->getAttribute('default_image') : null;
            return $this->getCustomProperty('defaultMedia', $default);
        }

        $this->setCustomPropery('defaultMedia', $value);
        return $value;
    }

    /**
     * @param $value
     */
    public function setDefaultMedia($value)
    {
        $this->defaultMedia($value);
        $this->save();

        $model = $this->getModel();
        if ($this->collection_name == 'images') {
            $model->setAttribute('default_image', $value);
            $model->update();
        }
    }

    /**
     * @param $value
     */
    public function setCustomPropertiesAttribute($value)
    {
        if (is_string($value)) {
            $this->customPropertiesArray = null;
        } else {
            $this->customPropertiesArray = $value;
            $value = json_encode($value);
        }
        $this->setPropertyValue('custom_properties', $value);
    }
}
