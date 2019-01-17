<?php

namespace ByTIC\MediaLibrary\Validation\Violations;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Class MessageBag
 * @package ByTIC\MediaLibrary\Validation\Violations
 */
class ViolationsBag extends \Nip\Collections\Collection
{
    /**
     * @param string $glue
     * @return string
     */
    public function getMessageString($glue = ', ')
    {
        $messages = [];
        foreach ($this as $violation) {
            $messages[] = $violation->getMessage();
        }
        return implode($glue, $messages);
    }
}
