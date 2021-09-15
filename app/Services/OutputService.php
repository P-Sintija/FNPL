<?php

namespace App\Services;

use App\Conditions\Characters\Character;
use App\Conditions\Characters\CharacterCollection;
use App\Conditions\Recurrence\Recurrence;
use App\Services\InputService;

class OutputService
{
    private CharacterCollection $characterCollection;

    public function __construct(CharacterCollection $characterCollection)
    {
        $this->characterCollection = $characterCollection;
    }

    public function printOutput(Recurrence $recurrence, InputService $filePath): string
    {
        $output = [];
        foreach ($this->characterCollection->getSetCharacters() as $character) {
            $result = $this->resultContent($recurrence, $character, $filePath);
            $output[] = PHP_EOL . '>> First ' . $recurrence->title() . $character->title() . $result;
        }
        return $this->createOutput($filePath, $output);
    }

    private function resultContent(Recurrence $recurrence, Character $character, InputService $filePath): string
    {
        $result = $recurrence->execute($character->getCharacters($filePath));
        if (strlen($result) === 0) {
            $result = 'None';
        }
        return $result;
    }

    private function createOutput(InputService $filePath, array $results): string
    {
        array_unshift($results, $this->getFileName($filePath));
        return implode('', $results);
    }

    private function getFileName(InputService $filePath): string
    {
        $lastSeperator = strrpos($filePath->getInput(), '\\');
        return '>> File: ' . substr($filePath->getInput(), $lastSeperator + 1);
    }
}
