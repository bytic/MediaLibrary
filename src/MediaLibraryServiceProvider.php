<?php

namespace ByTIC\MediaLibrary;

use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Loaders\LoaderInterface;
use Nip\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;

/**
 * Class MediaLibraryServiceProvider.
 */
class MediaLibraryServiceProvider extends AbstractSignatureServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->getContainer()->set(LoaderInterface::class, Filesystem::class);
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [LoaderInterface::class];
    }
}
