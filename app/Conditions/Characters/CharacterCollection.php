<?php

namespace App\Conditions\Characters;

class CharacterCollection
{
    private array $characters = [];

    public function addChararcter(Character $character): void
    {
        $this->characters[] = $character;
    }

    public function getCharacters(): array
    {
        return $this->characters;
    }

    public function getSetCharacters(): array
    {
        $setCharacters = [];
        foreach ($this->characters as $character) {
            if ($character->isset()) {
                $setCharacters[] = $character;
            }
        }
        return $setCharacters;
    }
}
