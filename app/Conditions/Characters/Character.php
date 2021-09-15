<?php

namespace App\Conditions\Characters;

use App\Services\InputService;

interface Character
{
    public function condition(string $character): bool;

    public function isset(): bool;

    public function title(): string;

    public function getCharacters(InputService $path): array;
}
