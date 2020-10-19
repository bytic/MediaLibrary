<?php

namespace ByTIC\MediaLibrary\Models\MediaProperties;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\HasMedia\Traits\HasMediaPropertiesTrait;
use Nip\Records\AbstractModels\Record;
use Nip\Records\RecordManager;

/**
 * Class MediaProperties
 * @package ByTIC\MediaLibrary\Models\MediaRecords
 *
 * @method MediaProperty getNew()
 */
class MediaProperties extends RecordManager
{
    /**
     * @deprecated use initRelationsMedia
     */
    protected function initRelations()
    {
        parent::initRelations();

        $this->initRelationsMediaTrait();
    }

    protected function initRelationsMediaTrait()
    {
        $this->morphTo(
            'Model',
            ['morphTypeField' => 'model', 'fk' => 'model_id']
        );
    }

    /**
     * @param Record|HasMediaPropertiesTrait $model
     * @param Collection|string $collection
     * @return MediaProperty|Record
     */
    public function for(Record $model, $collection)
    {
        $collection = is_object($collection) ? $collection->getName() : $collection;
        if ($model->hasRelation('MediaProperties')) {
            return $model->getRelation('MediaProperties')->getResults()->filter(
                function ($item) use ($collection) {
                    return $item->collection_name == $collection;
                }
            )->current();
        }

        return $this->findOneByParams([
            'where' => [
                ['model =?', $model->getManager()->getMorphName()],
                ['model_id =?', $model->getPrimaryKey()],
                ['collection_name=?', $collection]
            ]
        ]);
    }

    /**
     * @param $collection
     * @return MediaProperty|Record
     */
    public function forCollection(Collection $collection)
    {
        return $this->for($collection->getRecord(), $collection->getName());
    }

    /**
     * @param Record|HasMediaPropertiesTrait $model
     * @param $collection
     * @return MediaProperty
     */
    public function createFor(Record $model, $collection)
    {
        $record = $this->getNew();
        $record->populateFromModel($model);
        $record->populateFromCollection($collection);
        $record->setCustomPropertiesAttribute('{}');
        $record->insert();
        return $record;
    }

    /**
     * @inheritDoc
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function generateTable()
    {
        return 'media-properties';
    }
}
