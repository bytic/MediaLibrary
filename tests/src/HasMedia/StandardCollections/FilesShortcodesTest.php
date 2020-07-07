<?php

namespace ByTIC\MediaLibrary\Tests\HasMedia\StandardCollections;

use ByTIC\MediaLibrary\Collections\Collection;
use ByTIC\MediaLibrary\FileAdder\FileAdder;
use ByTIC\MediaLibrary\Loaders\Filesystem;
use ByTIC\MediaLibrary\Media\Media;
use ByTIC\MediaLibrary\Tests\AbstractTest;
use ByTIC\MediaLibrary\Tests\Fixtures\Models\Articles\Articles;

/**
 * Class FilesShortcodesTest.
 */
class FilesShortcodesTest extends AbstractTest
{
    public function testGetBasePathForMedia()
    {
        $manager = new Articles();
        $article = $manager->getNew();
        $article->id = 9;

        $mediaCollection = $article->getFiles();
        self::assertInstanceOf(Collection::class, $mediaCollection);

        $loader = $mediaCollection->getLoader();
        self::assertInstanceOf(Filesystem::class, $loader);
        self::assertSame('/files/articles/9/', $loader->getBasePath());
    }

    public function testGetFiles()
    {
        $manager = new Articles();
        $article = $manager->getNew();
        $article->id = 9;

        $mediaCollection = $article->getFiles();
        self::assertInstanceOf(Collection::class, $mediaCollection);
        self::assertSame(1, $mediaCollection->count());

        $file = $mediaCollection->get('test.txt');
        self::assertInstanceOf(Media::class, $file);
    }

    public function testAddFileFromPath()
    {
        $manager = new Articles();
        $article = $manager->getNew();
        $article->id = 9;

        $adder = $article->addFile(
            TEST_FIXTURE_PATH . DIRECTORY_SEPARATOR . 'test-files' . DIRECTORY_SEPARATOR . 'image1.gif'
        );

        self::assertInstanceOf(FileAdder::class, $adder);

        $files = $article->getFiles();
        self::assertInstanceOf(Collection::class, $files);
        self::assertSame(2, $files->count());

        $imageFile = $files->get('image1.gif');
        self::assertInstanceOf(Media::class, $imageFile);

        $files->deleteMediaByKey('image1.gif');
        self::assertSame(1, $files->count());
    }

    public function testAddFileFromContent()
    {
        $manager = new Articles();
        $article = $manager->getNew();
        $article->id = 9;

        $article->addFileFromContent('test', 'testAdd.txt');

        $files = $article->getFiles();
        self::assertInstanceOf(Collection::class, $files);
        self::assertSame(2, $files->count());

        $addedMedia = $files->get('testAdd.txt');
        self::assertInstanceOf(Media::class, $addedMedia);
        self::assertSame('test', $addedMedia->read());

        $files->deleteMediaByKey('testAdd.txt');
        self::assertCount(1, $files);
    }
}
