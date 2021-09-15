<?php

namespace App\Services;

use App\Models\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class WebOutputService
{
    const STORAGE_DIR = '';
    const SCRIPT_PATH = '\Scripts\Script.php';

    public function execute(Request $request, array $file): void
    {
        $filePath = self::STORAGE_DIR . basename($file['name']);
        $this->uploadFile($file, $filePath);

        Artisan::call('script', [
            'scriptPath' => __DIR__ . '\\..\\' . self::SCRIPT_PATH,
            '--input' => '=' . $filePath,
            '--format' => '=' . $request['recurrence'],
            '-L' => $request['letter'],
            '-P' => $request['punctuation'],
            '-S' => $request['symbol']
        ]);
    }

    public function getResult(): Input
    {
        return Input::latest()->first();
    }

    public function getOutput(?int $id): array
    {
        $result = [];
        $input = Input::where('id', $id)->first();
        if ($input) {
            $result = explode('>>', $input->result);
        }
        return $result;
    }

    private function uploadFile(array $file, string $filePath): void
    {
        move_uploaded_file($file['tmp_name'], $filePath);
    }
}
