<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Conditions\Recurrence\NonRepeating;
use App\Conditions\Recurrence\LeastRepeating;
use App\Conditions\Recurrence\MostRepeating;
use App\Conditions\Recurrence\RecurrenceCollection;
use App\Services\FormatFlagService;
use App\Services\InputService;

class FormatFlagServiceTest extends TestCase
{
    public function testVerifyFormatFlag(): void
    {
        $recurrenceCollection = new RecurrenceCollection;
        $recurrenceCollection->addRecurrence(new NonRepeating('non-repeating'));
        $recurrenceCollection->addRecurrence(new LeastRepeating('least-repeating'));
        $recurrenceCollection->addRecurrence(new MostRepeating('most-repeating'));
        $formatFlagService = new FormatFlagService($recurrenceCollection);
        $format = new InputService('least-repeating');
        $this->assertIsBool($formatFlagService->verifyFormatFlag($format));
        $this->assertTrue($formatFlagService->verifyFormatFlag($format) === true);
        $format = new InputService('repeating');
        $this->assertTrue($formatFlagService->verifyFormatFlag($format) === false);
    }
}
