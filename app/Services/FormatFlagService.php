<?php

namespace App\Services;

use App\Conditions\Recurrence\RecurrenceCollection;

class FormatFlagService
{
    private RecurrenceCollection $recurrenceCollection;

    public function __construct(RecurrenceCollection $recurrenceCollection)
    {
        $this->recurrenceCollection = $recurrenceCollection;
    }

    public function verifyFormatFlag(InputService $format): bool
    {
        return $this->flagProvided($format) && $this->verifyValue($format);
    }

    private function flagProvided(InputService $format): bool
    {
        return $format !== null;
    }

    private function verifyValue(InputService $format): bool
    {
        if ($this->recurrenceCollection->getRecurrence($format)) {
            return true;
        }
        return false;
    }
}
