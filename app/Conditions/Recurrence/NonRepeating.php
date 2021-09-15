<?php

namespace App\Conditions\Recurrence;

class NonRepeating implements Recurrence
{
    const TITLE = 'non repeating ';
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

        if (count($occurrences) > 0) {
            return $this->character($characterOccurrences, $occurrences);
        }
        return '';
    }

    private function character(array $characters, array $occurrences): string
    {
        $countMinRepeating = $occurrences[array_key_first($occurrences)];
        if ($countMinRepeating === 1) {
            foreach ($characters as $key => $value) {
                if ($value === $countMinRepeating) {
                    return $key;
                }
            }
        }
        return '';
    }
}
