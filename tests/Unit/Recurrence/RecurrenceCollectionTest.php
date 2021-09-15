<?php

namespace Tests\Unit\Recurrence;

use PHPUnit\Framework\TestCase;
use App\Conditions\Recurrence\Recurrence;
use App\Conditions\Recurrence\NonRepeating;
use App\Conditions\Recurrence\LeastRepeating;
use App\Conditions\Recurrence\RecurrenceCollection;
use App\Services\InputService;

class RecurrenceCollectionTest extends TestCase
{
    public function testGetRecurrence(): void
    {
        $recurrenceCollection = new RecurrenceCollection;
        $recurrenceCollection->addRecurrence(new NonRepeating('non-repeating'));
        $input = new InputService('non-repeating');
        $this->assertInstanceOf(Recurrence::class, $recurrenceCollection->getRecurrence($input));
        $input = new InputService('least-repeating');
        $this->assertNull($recurrenceCollection->getRecurrence($input));
        $recurrenceCollection->addRecurrence(new LeastRepeating('least-repeating'));
        $this->assertInstanceOf(Recurrence::class, $recurrenceCollection->getRecurrence($input));
    }
}
