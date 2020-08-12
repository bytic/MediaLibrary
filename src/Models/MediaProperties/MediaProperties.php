<?php

namespace ByTIC\MediaLibrary\Models\MediaProperties;

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
     * @param Record $model
     * @param $collection
     * @return MediaProperty|Record
     */
    public function for(Record $model, $collection)
    {
        if ($model->hasRelation('MediaProperties')) {
            return $model->getRelation('MediaProperties')->getResults()->filter(
                function ($item) use ($collection) {
                    return $item->collection_name == $collection;
                }
            )->current();
        }

        return $this->findOneByParams([
            'where' => [
                ['model =?', $model->getManager()->getController()],
                ['model_id =?', $model->getPrimaryKey()],
                ['collection_name=?', $collection]
            ]
        ]);
    }

    /**
     * @param Record $model
     * @param $collection
     * @return MediaProperty
     */
    public function createFor(Record $model, $collection)
    {
        $record = $this->getNew();
        $record->populateFromModel($model);
        $record->populateFromCollection($collection);
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
