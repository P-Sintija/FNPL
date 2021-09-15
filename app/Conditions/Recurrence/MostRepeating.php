<?php

namespace App\Conditions\Recurrence;

class MostRepeating implements Recurrence
{
    const TITLE = 'most repeating ';
    private string $recurrence;

    public function __construct(string $recurrence)
    {
        $this->recurrence = $recurrence;
    }

    public function recurrence(): string
    {
        return $this->recurrence;
    }

    public function title(): string
    {
        return self::TITLE;
    }

    public function execute(array $characters): string
    {
        $characterOccurrences = array_count_values($characters);
        $occurrences = (array_unique(array_values($characterOccurrences)));
        asort($occurrences);
        if (
            count($occurrences) > 1 ||
            (count($occurrences) === 1 && $occurrences[array_key_first($occurrences)] !== 1)
        ) {
            return $this->getLatsOccurrence($characterOccurrences, $occurrences);
        }
        return '';
    }

    private function getLatsOccurrence(array $characters, array $occurrences): string
    {
        $maxRepeating = $occurrences[array_keys($occurrences)[count($occurrences) - 1]];
        foreach ($characters as $key => $value) {
            if ($value === $maxRepeating) {
                return $key;
            }
        }
        return '';
    }
}
