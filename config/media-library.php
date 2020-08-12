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

    'contraints' => [
        'image' => [
//            'min' => ,
//            'max'   => 8192,  //kilobytes
        ],
    ],
];
