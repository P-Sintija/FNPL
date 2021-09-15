<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\ErrorMessageService;

class ErrorMessageServiceTest extends TestCase
{
    public function testErrorCode(): void
    {
        $errormessageService = new ErrorMessageService;
        $this->assertIsString($errormessageService->errorCode('Condition#2'));
        $this->assertTrue($errormessageService->errorCode('Condition#3') === 'Error code: 4');
    }
}
