<?php

namespace Tests\Unit\Characters;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\Character;
use App\Conditions\Characters\Symbol;
use App\Services\InputService;

class SymbolTest extends TestCase
{
    public function testImplementation(): void
    {
        $symbol = new Symbol(false);
        $this->assertInstanceOf(Character::class, $symbol);
    }

    public function testCondition(): void
    {
        $symbol = new Symbol(false);
        $this->assertIsBool($symbol->condition('a'));
        $this->assertTrue($symbol->condition('a') === false);
        $this->assertNotTrue($symbol->condition('A') === true);
        $this->assertTrue($symbol->condition('8') === false);
        $this->assertTrue($symbol->condition('$') === true);
        $this->assertFalse($symbol->condition('!') === true);
    }

    public function testIsset(): void
    {
        $symbol = new Symbol(false);
        $this->assertIsBool($symbol->isset());
        $this->assertTrue($symbol->isset() === false);
        $symbol = new Symbol(true);
        $this->assertTrue($symbol->isset() === true);
    }

    public function testTitle(): void
    {
        $symbol = new Symbol(true);
        $this->assertIsString($symbol->title());
        $this->assertTrue($symbol->title() === 'symbol: ');
    }

    public function testGetCharacters(): void
    {
        $path = new InputService('tests\Unit\Characters\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        $text = 'abjg%&${@?AB,"';
        fwrite($file, $text);
        fclose($file);
        $symbol = new Symbol(true);
        $this->assertTrue($symbol->getCharacters($path) === ['$']);
        $this->assertIsArray($symbol->getCharacters($path));
        unlink($path->getInput());
    }
}
