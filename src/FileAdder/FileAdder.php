<?php

namespace ByTIC\MediaLibrary\FileAdder;

use ByTIC\MediaLibrary\HasMedia\Interfaces\HasMedia;
use ByTIC\MediaLibrary\Media\Media;
use Nip\Logger\Exception;
use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

/**
 * Class FileAdder.
 */
class FileAdder implements FileAdderInterface
{
    use Traits\HasFileTrait;
    use Traits\HasSubjectTrait;
    use Traits\HasMediaRepository;
    use Traits\FileAdderProcessesTrait;

    /** @var null|\ByTIC\MediaLibrary\Media\Media */
    protected $media = null;

    /** @var string */
    protected $mediaName;

    /** @var string */
    protected $fileName;

    /**
     * Set the name of the file that is stored on disk.
     *
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName(string $fileName)
    {
        $this->fileName = $this->sanitizeFileName($fileName);

        return $this;
    }

    /**
     * @param $fileName
     *
     * @return string
     */
    protected function sanitizeFileName(string $fileName): string
    {
        return str_replace(['#', '/', '\\'], '-', $fileName);
    }

    /**
     * @return Media|null
     */
    public function getMedia()
    {
        if ($this->media === null) {
            $this->setMedia($this->createMedia());
        }

        return $this->media;
    }

    /**
     * @param Media|null $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @throws Exception
     *
     * @return Media
     */
    protected function createMedia()
    {
        if (($this->getFile() instanceof SymfonyFile) === false) {
            throw new Exception(self::NO_FILE_DEFINED);
        }
        if (($this->subject instanceof HasMedia) === false) {
            throw new Exception(self::NO_SUBJECT_DEFINED);
        }
        $media = new Media();
        $media->setModel($this->getSubject());

        return $media;
    }

    /**
     * @return string
     */
    public function getMediaName(): string
    {
        return $this->mediaName;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }
}
