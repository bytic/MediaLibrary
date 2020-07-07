<?php

namespace ByTIC\MediaLibrary\Media\Traits;

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
        $converstions = $this->getConversionNames();
        $converstions[] = 'full';
        $filesystem = $this->getFile()->getFilesystem();
        foreach ($converstions as $converstion) {
            $path = $this->getPath($converstion);
            if ($filesystem->has($path)) {
                $filesystem->delete($path);
            }
        }
        if ($this->getFile()->exists()) {
            $this->getFile()->delete();
        }
        return true;
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
