<?php

namespace ByTIC\MediaLibrary\Media\Traits;

use ByTIC\MediaLibrary\Loaders\Database;
use ByTIC\MediaLibrary\Support\MediaModels;
use Exception;
use League\Flysystem\File as FileLeague;
use Nip\Filesystem\File;

/**
 * Trait FileMethodsTrait.
 */
trait FileMethodsTrait
{
    /**
     * @var File|FileLeague
     */
    protected $file;

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /**
     * @return bool
     */
    public function hasFile()
    {
        return $this->getFile() instanceof File;
    }

    /**
     * @param $path
     * @param $contents
     */
    public function generateFileFromContent($path, $contents)
    {
        $this->getCollection()->getFilesystem()->put(
            $path,
            $contents
        );

        $file = new File($this->getCollection()->getFilesystem(), $path);
        $this->setFile($file);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getFile()->getName();
    }

    /**
     * @return string
     */
    public function read()
    {
        return $this->getFile()->read();
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $this->deleteMediaFromFilesystem();
        $this->deleteMediaFromDatabase();
        return true;
    }

    protected function deleteMediaFromDatabase()
    {
        $loader = $this->getCollection()->getLoader();
        if ($loader instanceof Database) {
            MediaModels::records()->deteleMedia($this);
        }
    }

    protected function deleteMediaFromFilesystem()
    {
        $this->removeConversions();
        if ($this->getFile()->exists()) {
            $this->getFile()->delete();
        }
    }

    /**
     * Get the path to the original media file.
     *
     * @param string $conversionName
     *
     * @throws Exception
     *
     * @return string
     */
    public function getPath(string $conversionName = ''): string
    {
        if (!$this->hasFile()) {
            throw  new Exception('Error getting path for media with no file');
        }

        if ($conversionName) {
            return $this->getBasePath($conversionName) . DIRECTORY_SEPARATOR . $this->getName();
        }

        return $this->getFile()->getPath();
    }
}
