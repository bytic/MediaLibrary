<?php

namespace ByTIC\MediaLibrary\Conversions;

use ByTIC\MediaLibrary\Media\Media;

/**
 * Class ConversionCreator
 * @package ByTIC\MediaLibrary\Conversions
 */
class ConversionCreator
{
    /**
     * @var Media
     */
    protected $media;

    /**
     * @var ConversionCollection
     */
    protected $conversions;

    /**
     * ConversionCreator constructor.
     * @param Media $media
     */
    public function __construct(Media $media)
    {
        $this->setMedia($media);
    }

    /**
     * @param Media $media
     *
     * @return $this
     */
    public function setMedia(Media $media)
    {
        $this->media = $media;
        $this->addConversionsFromRelatedModel($media);
        return $this;
    }

    /**
     * Add the conversion that are defined on the related model of
     * the given media.
     *
     * @param Media $media
     */
    protected function addConversionsFromRelatedModel(Media $media)
    {
        $model = $media->getModel();
        $conversionCollection = $model->getMediaConversions()->forCollection(
            $media->getCollection()->getName()
        );
        $this->setConversions($conversionCollection);
    }

    /**
     * Perform conversions for the given media.
     */
    public function performConversions()
    {
        if ($this->getConversions()->count() < 1) {
            return;
        }

//        $imageGenerator = $this->determineImageGenerator($media);
//        if (! $imageGenerator) {
//            return;
//        }

        $temporaryDirectory = new TemporaryDirectory($this->getTemporaryDirectoryPath());
        $copiedOriginalFile = app(Filesystem::class)->copyFromMediaLibrary(
            $media,
            $temporaryDirectory->path(str_random(16) . '.' . $media->extension)
        );

        foreach ($conversions as $conversion) {
            $copiedOriginalFile = $imageGenerator->convert($copiedOriginalFile, $conversion);
            $conversionResult = $this->performConversion($media, $conversion, $copiedOriginalFile);
            $newFileName = $conversion->getName()
                . '.'
                . $conversion->getResultExtension(pathinfo($copiedOriginalFile, PATHINFO_EXTENSION));
            $renamedFile = MediaLibraryFileHelper::renameInDirectory($conversionResult, $newFileName);
            app(Filesystem::class)->copyToMediaLibrary($renamedFile, $media, true);
            event(new ConversionHasBeenCompleted($media, $conversion));
        }
        $temporaryDirectory->delete();

    }

    /**
     * @return ConversionCollection
     */
    public function getConversions()
    {
        return $this->conversions;
    }

    /**
     * @param ConversionCollection $conversions
     */
    public function setConversions(ConversionCollection $conversions)
    {
        $this->conversions = $conversions;
    }

    public function performConversion(Media $media, Conversion $conversion, string $imageFile): string
    {
        $conversionTempFile = pathinfo($imageFile, PATHINFO_DIRNAME) . '/' . str_random(16)
            . $conversion->getName()
            . '.'
            . $media->extension;

        File::copy($imageFile, $conversionTempFile);
        $supportedFormats = ['jpg', 'pjpg', 'png', 'gif'];
        if ($conversion->shouldKeepOriginalImageFormat() && in_array($media->extension, $supportedFormats)) {
            $conversion->format($media->extension);
        }

        Image::load($conversionTempFile)
            ->useImageDriver(config('medialibrary.image_driver'))
            ->manipulate($conversion->getManipulations())
            ->save();
        return $conversionTempFile;
    }

    /**
     *
     * @return \Spatie\MediaLibrary\ImageGenerators\ImageGenerator|null
     */
    public function determineImageGenerator()
    {
//        return $media->getImageGenerators()
//            ->map(function (string $imageGeneratorClassName) {
//                return app($imageGeneratorClassName);
//            })
//            ->first(function (ImageGenerator $imageGenerator) use ($media) {
//                return $imageGenerator->canConvert($media);
//            });
    }
}
