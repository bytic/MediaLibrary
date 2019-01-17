<?php

namespace ByTIC\MediaLibrary\Validation\Constraints;

/**
 * Class Image
 * @package ByTIC\MediaLibrary\Validation\Constraints
 */
class FileConstraint extends AbstractConstraint
{

    const NOT_FOUND_ERROR = 'd2a3fb6e-7ddc-4210-8fbf-2ab345ce1998';
    const NOT_READABLE_ERROR = 'c20c92a4-5bfa-4202-9477-28e800e0f6ff';
    const EMPTY_ERROR = '5d743385-9775-4aa5-8ff5-495fb1e60137';
    const TOO_LARGE_ERROR = 'df8637af-d466-48c6-a59d-e7126250a654';
    const INVALID_MIME_TYPE_ERROR = '744f00bc-4389-4c74-92de-9a43cde55534';

    protected static $errorNames = [
        self::NOT_FOUND_ERROR => 'NOT_FOUND_ERROR',
        self::NOT_READABLE_ERROR => 'NOT_READABLE_ERROR',
        self::EMPTY_ERROR => 'EMPTY_ERROR',
        self::TOO_LARGE_ERROR => 'TOO_LARGE_ERROR',
        self::INVALID_MIME_TYPE_ERROR => 'INVALID_MIME_TYPE_ERROR',
    ];


    protected $maxSize;
    public $mimeTypes = [];
}
