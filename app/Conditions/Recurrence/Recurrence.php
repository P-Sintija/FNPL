<?php

namespace App\Conditions\Recurrence;

interface Recurrence
{
    public function title(): string;

    public function execute(array $characters): string;
}
