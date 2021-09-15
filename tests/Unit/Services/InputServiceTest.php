<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\InputService;

class InputServiceTest extends TestCase
{
    public function testGetInput(): void
    {
        $input = new InputService('=repeating');
        $this->assertIsString($input->getInput());
        $this->assertTrue($input->getInput() === 'repeating');
        $input = new InputService(null);
        $this->assertNull($input->getInput());
    }
}
