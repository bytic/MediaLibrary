<?php

namespace ByTIC\MediaLibrary\HasMedia\StandardCollections;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\Media\Media;

/**
 * Trait StandardCollectionsShortcodes.
 *
 * @method Collection getMedia(string $collectionName = 'default', $filters = []): Collection
 */
trait FilesShortcodes
{
    /**
     * @return Collection|Media[]
     *
     * @deprecated Use getFiles
     */
    public function findFiles()
    {
        return $this->getFiles();
    }

    /**
     * @return Collection|Media[]
     */
    public function getFiles()
    {
        return $this->getMedia('files');
    }

    /**
     * @param $file
     *
     * @return FileAdder
     */
    public function addFile($file)
    {
        return $this->addMediaToCollection($file, 'files');
    }

    /**
     * @param $content
     * @param $name
     */
    public function addFileFromContent($content, $name)
    {
        $path = sys_get_temp_dir();
        $fullPath = $path . DIRECTORY_SEPARATOR . $name;
        file_put_contents($fullPath, $content);
        $this->addFile($fullPath);
    }
}
