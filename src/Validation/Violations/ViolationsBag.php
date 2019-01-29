<?php

namespace ByTIC\MediaLibrary\Validation\Violations;

/**
 * Class MessageBag.
 */
class ViolationsBag extends \Nip\Collections\Collection
{
    /**
     * @param string $glue
     *
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
