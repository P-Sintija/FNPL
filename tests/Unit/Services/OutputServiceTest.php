<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\CharacterCollection;
use App\Conditions\Characters\Symbol;
use App\Conditions\Recurrence\NonRepeating;
use App\Services\InputService;
use App\Services\OutputService;

class OutputServiceTest extends TestCase
{
    public function testPrintOutput(): void
    {
        $characterCollection = new CharacterCollection;
        $characterCollection->addChararcter(new Symbol(true));
        $outputService = new OutputService($characterCollection);
        $recurrence = new NonRepeating('non-repeating');
        $path = new InputService('tests\Unit\Services\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        $text = 'abjg${@?,"';
        fwrite($file, $text);
        fclose($file);
        $this->assertIsString($outputService->printOutput($recurrence, $path));;
        unlink($path->getInput());
    }
}
