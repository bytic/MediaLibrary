<?php

namespace ByTIC\MediaLibrary\Models\MediaRecords;

use ByTIC\MediaLibrary\Models\MediaProperties\MediaProperty;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Collections\Collection;
use Nip\Records\RecordManager;

/**
 * Class MediaRecords
 * @package ByTIC\MediaLibrary\Models\MediaRecords
 *
 * @method MediaRecord getNew
 */
class MediaRecords extends RecordManager
{

    /**
     * @param Record $model
     * @param $collection
     * @return MediaProperty[]|Collection
     */
    public function for(Record $model, $collection)
    {
        if ($model->hasRelation('Media')) {
            return $model->getRelation('Media')->getResults()->filter(
                function ($item) use ($collection) {
                    return $item->collection_name == $collection;
                }
            );
        }

        return $this->findByParams([
            'where' => [
                ['model =?', $model->getManager()->getController()],
                ['model_id =?', $model->getPrimaryKey()],
                ['collection_name=?', $collection]
            ]
        ]);
    }

    /**
     * @param $file
     * @param Record $model
     * @param $collection
     * @return Record
     */
    public function createFor($file, Record $model, $collection)
    {
        $record = $this->getNew();
        $record->populateFromFile($file);
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
        return 'media-records';
    }
}
