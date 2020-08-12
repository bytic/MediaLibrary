<?php

namespace ByTIC\MediaLibrary;

use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Loaders\LoaderInterface;
use Nip\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;
use Nip\Container\ServiceProviders\Providers\BootableServiceProviderInterface;

/**
 * Class MediaLibraryServiceProvider.
 */
class MediaLibraryServiceProvider extends AbstractSignatureServiceProvider implements BootableServiceProviderInterface
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

    public function boot()
    {
        $this->getContainer()->get('migrations.migrator')->path(dirname(__DIR__) . '/migrations/');
    }
}
