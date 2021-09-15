<?php

namespace Tests\Unit\Recurrence;

use PHPUnit\Framework\TestCase;
use App\Conditions\Recurrence\NonRepeating;

class NonRepeatingTest extends TestCase
{
    public function testRecurrence(): void
    {
        $recurrence = new NonRepeating('non-repeating');
        $this->assertIsString($recurrence->recurrence());
        $this->assertTrue($recurrence->recurrence() === 'non-repeating');
    }

    public function testTitle(): void
    {
        $recurrence = new NonRepeating('non-repeating');
        $this->assertIsString($recurrence->title());
        $this->assertTrue($recurrence->title() === 'non repeating ');
    }

    public function testExecute(): void
    {
        $recurrence = new NonRepeating('non-repeating');
        $characters = ['a', 'a', 'd', 'f', '!', '*', 'b', 'b', 'b', 'c', 'c'];
        $this->assertTrue($recurrence->execute($characters) === 'd');
        $this->assertIsString($recurrence->execute($characters));
    }
}
