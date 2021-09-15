<?php

namespace App\Conditions\Recurrence;

class LeastRepeating implements Recurrence
{
    const TITLE = 'least repeating ';
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

        if (count($occurrences) === 1 && $occurrences[array_key_first($occurrences)] !== 1) {
            return $this->checkFirstOccurrence($characterOccurrences, $occurrences);
        } else if (count($occurrences) > 1) {
            return $this->getSecondOccurence($characterOccurrences, $occurrences);
        }
        return '';
    }

    private function checkFirstOccurrence(array $characters, array $occurrences): string
    {
        $countMinRepeating = $occurrences[array_key_first($occurrences)];
        foreach ($characters as $key => $value) {
            if ($value === $countMinRepeating) {
                return $key;
            }
        }
    }

    private function getSecondOccurence(array $characters, array $occurrences): string
    {
        $secondMinRepeating = $occurrences[array_keys($occurrences)[1]];
        foreach ($characters as $key => $value) {
            if ($value === $secondMinRepeating) {
                return $key;
            }
        }
    }
}
