<?php

namespace App\Services;

use App\Conditions\Characters\CharacterCollection;

class IncludeCharacterService
{
    private CharacterCollection $characterCollection;

    public function __construct(CharacterCollection $characterCollection)
    {
        $this->characterCollection = $characterCollection;
    }

    public function verifyIncludeValue(): bool
    {
        return count($this->characterCollection->getSetCharacters()) !== 0;
    }
}
