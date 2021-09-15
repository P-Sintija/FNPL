<?php

namespace App\Conditions\Recurrence;

use App\Services\InputService;

class RecurrenceCollection
{
    private array $recurrences = [];

    public function addRecurrence(Recurrence $recurrence): void
    {
        $this->recurrences[] = $recurrence;
    }

    public function getRecurrence(InputService $input): ?Recurrence
    {
        foreach ($this->recurrences as $recurrence) {
            if ($recurrence->recurrence() === $input->getInput()) {
                return $recurrence;
            }
        }
        return null;
    }
}
