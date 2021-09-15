<?php

namespace App\Conditions\Characters;

use App\Services\InputService;

class LowercaseLetter implements Character
{
    const TITLE = 'letter: ';
    private bool $isset;
    private array $characters = [];

    public function __construct(bool $isset)
    {
        $this->isset = $isset;
    }

    public function condition(string $character): bool
    {
        return ctype_lower($character);
    }

    public function isset(): bool
    {
        return $this->isset;
    }

    public function title(): string
    {
        return self::TITLE;
    }

    public function getCharacters(InputService $path): array
    {
        $content = str_split(file_get_contents($path->getInput()));
        for ($i = 0; $i < count($content); $i++) {
            if ($this->condition($content[$i])) {
                $this->characters[] = $content[$i];
            }
        }
        return $this->characters;
    }
}
