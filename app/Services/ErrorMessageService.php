<?php

namespace App\Services;

class ErrorMessageService
{
    const ERROR_CODES = [
        'Condition#1-1' => '1',
        'Condition#1-2' => '2',
        'Condition#2' => '3',
        'Condition#3' => '4'
    ];

    public function errorCode(string $key): string
    {
        return '>> Error code: ' . self::ERROR_CODES[$key];
    }
}
