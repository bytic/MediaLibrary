<?php

return [

    /*
     * The disk on which to store added files and derived images by default. Choose
     * one or more of the disks you've configured in config/filesystems.php.
     */
    'disk_name' => env('MEDIA_DISK', 'public'),

    /*
     * The fully qualified class names of the media models.
     */
    'media_models' => [
        'records' => ByTIC\MediaLibrary\Models\MediaRecords\MediaRecords::class,
        'properties' => ByTIC\MediaLibrary\Models\MediaProperties\MediaProperties::class,
    ],

    /*
     * The fully qualified class name of the media model.
     */
    'media_loader' => ByTIC\MediaLibrary\Loaders\Database::class,

    /*
     * Image conversion settings.
     *
     * JPEG and WebP output use a high quality by default. Metadata is stripped
     * to avoid unnecessary payload, while progressive JPEGs decode more smoothly.
     */
    'images' => [
        'quality' => env('MEDIA_IMAGE_QUALITY', 95),
    ],

    'contraints' => [
        'image' => [
//            'min' => ,
//            'max'   => 8192,  //kilobytes
        ],
    ],
];
