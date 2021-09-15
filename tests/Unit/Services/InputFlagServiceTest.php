<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\CharacterCollection;
use App\Conditions\Characters\LowercaseLetter;
use App\Conditions\Characters\Punctuation;
use App\Conditions\Characters\Symbol;
use App\Services\InputFlagService;
use App\Services\InputService;

class InputFlagServiceTest extends TestCase
{
    public function testVerifyInputFlag(): void
    {
        $characterCollection = new CharacterCollection;
        $characterCollection->addChararcter(new LowercaseLetter(false));
        $inputFlagService = new InputFlagService($characterCollection);
        $path = new InputService('tests\Unit\Services\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        fclose($file);
        $this->assertIsBool($inputFlagService->verifyInputFlag($path));
        $this->assertTrue($inputFlagService->verifyInputFlag($path) === true);
        unlink($path->getInput());
    }

    public function testVerifyFileContent(): void
    {
        $characterCollection = new CharacterCollection;
        $characterCollection->addChararcter(new LowercaseLetter(false));
        $characterCollection->addChararcter(new Punctuation(false));
        $characterCollection->addChararcter(new Symbol(false));
        $inputFlagService = new InputFlagService($characterCollection);
        $path = new InputService('tests\Unit\Services\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        $text = 'abjg${@?,"';
        fwrite($file, $text);
        fclose($file);
        $this->assertIsBool($inputFlagService->verifyFileContent($path));
        $this->assertTrue($inputFlagService->verifyFileContent($path) === true);
        unlink($path->getInput());

        $path = new InputService('tests\Unit\Services\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        $text = 'ab6jg${@?AB,"';
        fwrite($file, $text);
        fclose($file);
        $this->assertIsBool($inputFlagService->verifyFileContent($path));
        $this->assertTrue($inputFlagService->verifyFileContent($path) === false);
        unlink($path->getInput());
    }
}
