<?php

namespace Tests\Unit\Characters;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\Character;
use App\Conditions\Characters\LowercaseLetter;
use App\Services\InputService;

class LowercaseLetterTest extends TestCase
{
    public function testImplementation(): void
    {
        $lowercaseLetter = new LowercaseLetter(false);
        $this->assertInstanceOf(Character::class, $lowercaseLetter);
    }

    public function testCondition(): void
    {
        $lowercaseLetter = new LowercaseLetter(false);
        $this->assertIsBool($lowercaseLetter->condition('a'));
        $this->assertTrue($lowercaseLetter->condition('a') === true);
        $this->assertNotTrue($lowercaseLetter->condition('A') === true);
        $this->assertTrue($lowercaseLetter->condition('8') === false);
        $this->assertFalse($lowercaseLetter->condition('%') === true);
        $this->assertFalse($lowercaseLetter->condition('!') === true);
    }

    public function testIsset(): void
    {
        $lowercaseLetter = new LowercaseLetter(false);
        $this->assertIsBool($lowercaseLetter->isset());
        $this->assertTrue($lowercaseLetter->isset() === false);
        $lowercaseLetter = new LowercaseLetter(true);
        $this->assertTrue($lowercaseLetter->isset() === true);
    }

    public function testTitle(): void
    {
        $lowercaseLetter = new LowercaseLetter(true);
        $this->assertIsString($lowercaseLetter->title());
        $this->assertTrue($lowercaseLetter->title() === 'letter: ');
    }

    public function testGetCharacters(): void
    {
        $path = new InputService('tests\Unit\Characters\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        $text = 'abjg%&$.AB';
        fwrite($file, $text);
        fclose($file);
        $lowercaseLetter = new LowercaseLetter(true);
        $this->assertTrue($lowercaseLetter->getCharacters($path) === ['a', 'b', 'j', 'g']);
        $this->assertIsArray($lowercaseLetter->getCharacters($path));
        unlink($path->getInput());
    }
}
