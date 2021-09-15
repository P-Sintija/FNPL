<?php

namespace Tests\Unit\Characters;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\Character;
use App\Conditions\Characters\Punctuation;
use App\Services\InputService;

class PunctuationTest extends TestCase
{
    public function testImplementation(): void
    {
        $punctuation = new Punctuation(false);
        $this->assertInstanceOf(Character::class, $punctuation);
    }

    public function testCondition(): void
    {
        $punctuation = new Punctuation(false);
        $this->assertIsBool($punctuation->condition('a'));
        $this->assertTrue($punctuation->condition('a') === false);
        $this->assertNotTrue($punctuation->condition('A') === true);
        $this->assertTrue($punctuation->condition('8') === false);
        $this->assertTrue($punctuation->condition('^') === false);
        $this->assertFalse($punctuation->condition('!') === false);
    }

    public function testIsset(): void
    {
        $punctuation = new Punctuation(false);
        $this->assertIsBool($punctuation->isset());
        $this->assertTrue($punctuation->isset() === false);
        $punctuation = new Punctuation(true);
        $this->assertTrue($punctuation->isset() === true);
    }

    public function testTitle(): void
    {
        $punctuation = new Punctuation(true);
        $this->assertIsString($punctuation->title());
        $this->assertTrue($punctuation->title() === 'punctuation: ');
    }

    public function testGetCharacters(): void
    {
        $path = new InputService('tests\Unit\Characters\testFile.txt');
        $file = fopen($path->getInput(), 'w');
        $text = 'abjg${@?AB,"';
        fwrite($file, $text);
        fclose($file);
        $punctuation = new Punctuation(true);
        $this->assertTrue($punctuation->getCharacters($path) === ['{', '@', '?', ',', '"']);
        $this->assertIsArray($punctuation->getCharacters($path));
        unlink($path->getInput());
    }
}
