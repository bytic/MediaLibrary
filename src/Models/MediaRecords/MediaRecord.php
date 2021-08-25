<?php

namespace ByTIC\MediaLibrary\Models\MediaRecords;

use ByTIC\MediaLibrary\Collections\Collection;
use Nip\Filesystem\File;
use Nip\Records\Record;

/**
 * Class MediaRecord
 * @package ByTIC\MediaLibrary\Models\MediaRecords
 *
 * @property string $model
 * @property int $model_id
 * @property int $collection_name
 * @property int $file_name
 * @property int $path
 * @property int $disk
 */
class MediaRecord extends Record
{
    /**
     * @param \Nip\Records\AbstractModels\Record $model
     */
    public function populateFromFile(File $file)
    {
        $this->file_name = $file->getName();
        $this->path = $file->getPath();
    }

    /**
     * @param \Nip\Records\AbstractModels\Record $model
     */
    public function populateFromModel(Record $model)
    {
        $this->model = $model->getManager()->getMorphName();
        $this->model_id = $model->getPrimaryKey();
    }

    /**
     * @param Collection $collection
     */
    public function populateFromCollection($collection)
    {
        if (is_object($collection)) {
            $this->collection_name = $collection->getName();
            $this->disk = $collection->getMediaFilesystemDiskName();
            return;
        }
        $this->collection_name = $collection;
    }
}
