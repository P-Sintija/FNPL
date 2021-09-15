<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Conditions\Characters\CharacterCollection;
use App\Conditions\Characters\LowercaseLetter;
use App\Conditions\Characters\Punctuation;
use App\Conditions\Characters\Symbol;
use App\Services\IncludeCharacterService;

class IncludeCharacterServiceTest extends TestCase
{
    public function testVerifyFormatFlag(): void
    {
        $characterCollection = new CharacterCollection;
        $includeCharacterService = new IncludeCharacterService($characterCollection);
        $this->assertIsBool($includeCharacterService->verifyIncludeValue());
        $this->assertTrue($includeCharacterService->verifyIncludeValue() === false);
        $characterCollection->addChararcter(new LowercaseLetter(true));
        $characterCollection->addChararcter(new Punctuation(false));
        $characterCollection->addChararcter(new Symbol(true));
        $this->assertTrue($includeCharacterService->verifyIncludeValue() === true);
    }
}
