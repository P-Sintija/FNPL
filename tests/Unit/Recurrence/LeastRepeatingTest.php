<?php

namespace Tests\Unit\Recurrence;

use PHPUnit\Framework\TestCase;
use App\Conditions\Recurrence\LeastRepeating;

class LeastRepeatingTest extends TestCase
{
    public function testRecurrence(): void
    {
        $recurrence = new LeastRepeating('least-repeating');
        $this->assertIsString($recurrence->recurrence());
        $this->assertTrue($recurrence->recurrence() === 'least-repeating');
    }

    public function testTitle(): void
    {
        $recurrence = new LeastRepeating('least-repeating');
        $this->assertIsString($recurrence->title());
        $this->assertTrue($recurrence->title() === 'least repeating ');
    }

    public function testExecute(): void
    {
        $recurrence = new LeastRepeating('least-repeating');
        $characters = ['a', 'a', 'd', 'f', '!', '*', 'b', 'b', 'b', 'c', 'c'];
        $this->assertTrue($recurrence->execute($characters) === 'a');
        $this->assertIsString($recurrence->execute($characters));
    }
}
