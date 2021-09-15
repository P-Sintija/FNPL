<?php

namespace Tests\Unit\Characters;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\CharacterCollection;
use App\Conditions\Characters\LowercaseLetter;
use App\Conditions\Characters\Punctuation;
use App\Conditions\Characters\Symbol;

class CharacterCollectionTest extends TestCase
{
    public function testGetCharacters(): void
    {
        $characterCollection = new CharacterCollection;
        $characterCollection->addChararcter(new LowercaseLetter(true));
        $characterCollection->addChararcter(new Symbol(true));
        $this->assertIsArray($characterCollection->getCharacters());
        $this->assertCount(2, $characterCollection->getCharacters());
    }

    public function testGetSetCharacters(): void
    {
        $characterCollection = new CharacterCollection;
        $characterCollection->addChararcter(new LowercaseLetter(true));
        $characterCollection->addChararcter(new Symbol(false));
        $characterCollection->addChararcter(new Punctuation(true));
        $this->assertIsArray($characterCollection->getSetCharacters());
        $this->assertCount(2, $characterCollection->getSetCharacters());
    }
}
