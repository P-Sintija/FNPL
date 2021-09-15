<?php

namespace App\Services;

class InputService
{
    private ?string $input;

    public function __construct(?string $input)
    {
        $this->setInput($input);
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    private function setInput(?string $input): void
    {
        if (substr($input, 0, 1) === '=') {
            $input = substr($input, 1);
        }
        $this->input = $input;
    }
}
