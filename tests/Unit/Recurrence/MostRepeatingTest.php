<?php

namespace Tests\Unit\Recurrence;

use PHPUnit\Framework\TestCase;
use App\Conditions\Recurrence\MostRepeating;

class MostRepeatingTest extends TestCase
{
    public function testRecurrence(): void
    {
        $recurrence = new MostRepeating('most-repeating');
        $this->assertIsString($recurrence->recurrence());
        $this->assertTrue($recurrence->recurrence() === 'most-repeating');
    }

    public function testTitle(): void
    {
        $recurrence = new MostRepeating('most-repeating');
        $this->assertIsString($recurrence->title());
        $this->assertTrue($recurrence->title() === 'most repeating ');
    }

    public function testExecute(): void
    {
        $recurrence = new MostRepeating('most-repeating');
        $characters = ['a', 'a', 'd', 'f', '!', '*', 'b', 'b', 'b', 'c', 'c'];
        $this->assertTrue($recurrence->execute($characters) === 'b');
        $this->assertIsString($recurrence->execute($characters));
    }
}
