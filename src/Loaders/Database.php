<?php

namespace ByTIC\MediaLibrary\Loaders;

use ByTIC\MediaLibrary\Support\MediaModels;
use Nip\Filesystem\File;

/**
 * Class Database
 */
class Database extends AbstractLoader
{
    /**
     * @return File[]
     */
    public function getMediaFiles()
    {
        $files = $this->tryDatabase();
        if (is_array($files)) {
            return $files;
        }
        $files = $this->tryFilesystem();

        $model = $this->getCollection()->getRecord();

        foreach ($files as $file) {
            MediaModels::records()->createFor(
                $file,
                $model,
                $this->getCollection()->getName()
            );
        }

        $model->mediaProperties($this->getCollection())->saveDbLoaded(true);

        return $files;
    }

    /**
     * @return array|false
     */
    protected function tryDatabase()
    {
        $propertiesRecord = MediaModels::properties()->forCollection($this->getCollection());

        if (!is_object($propertiesRecord) || $propertiesRecord->dbLoaded() === false) {
            return false;
        }

        $mediaRecords = MediaModels::records()->for(
            $this->getCollection()->getRecord(),
            $this->getCollection()->getName()
        );
        $files = [];
        foreach ($mediaRecords as $mediaRecord) {
            $files[] = new File($this->getFilesystem(),$mediaRecord->path);
        }
        return $files;
    }

    /**
     * @return array|false
     */
    protected function tryFilesystem()
    {
        $loader = $this->initFromSibling(Filesystem::class);
        return $loader->getMediaFiles();
    }
}
