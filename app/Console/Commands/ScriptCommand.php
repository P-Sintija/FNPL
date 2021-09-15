<?php

namespace App\Console\Commands;

use App\Models\Input;
use Illuminate\Console\Command;

class ScriptCommand extends Command
{
    protected $signature = 'script 
                            {scriptPath} 
                            {--i|input=} 
                            {--f|format=}
                            {--L|include-letter}
                            {--P|include-punctuation}
                            {--S|include-symbol}
                            ';

    protected $description = 'Command for app\Script\Script.php';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $timeStart = microtime(true);
        $options = $this->options();
        require($this->argument('scriptPath'));
        $data = new Input;
        $result =  $output . PHP_EOL . '>> Total execution time: ' . (microtime(true) - $timeStart);
        $data->result = $result;
        $data->save();
        echo $result;
    }
}
