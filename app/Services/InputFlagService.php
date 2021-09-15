<?php

namespace App\Services;

use App\Conditions\Characters\CharacterCollection;

class InputFlagService
{
    private CharacterCollection $characterCollection;

    public function __construct(CharacterCollection $characterCollection)
    {
        $this->characterCollection = $characterCollection;
    }

    public function verifyInputFlag(InputService $path): bool
    {
        return $this->flagProvided($path) && $this->pathExists($path);
    }

    public function verifyFileContent(InputService $path): bool
    {
        $content = str_split(file_get_contents($path->getInput()));

        for ($i = 0; $i < count($content); $i++) {
            $conditionMet = 0;
            foreach ($this->characterCollection->getCharacters() as $character) {
                if (!$character->condition($content[$i])) {
                    $conditionMet++;
                }
            }

            if (count($this->characterCollection->getCharacters()) === $conditionMet) {
                return false;
            }
        }
        return true;
    }

    private function flagProvided(InputService $path): bool
    {
        return $path !== null;
    }

    private function pathExists(InputService $path): bool
    {
        return file_exists($path->getInput());
    }
}
