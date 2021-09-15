<?php

use App\Conditions\Characters\CharacterCollection;
use App\Conditions\Characters\LowercaseLetter;
use App\Conditions\Characters\Punctuation;
use App\Conditions\Characters\Symbol;
use App\Conditions\Recurrence\NonRepeating;
use App\Conditions\Recurrence\LeastRepeating;
use App\Conditions\Recurrence\MostRepeating;
use App\Conditions\Recurrence\RecurrenceCollection;
use App\Services\ErrorMessageService;
use App\Services\FormatFlagService;
use App\Services\IncludeCharacterService;
use App\Services\InputFlagService;
use App\Services\InputService;
use App\Services\OutputService;

$characterCollection = new CharacterCollection;
$characterCollection->addChararcter(new LowercaseLetter($options['include-letter']));
$characterCollection->addChararcter(new Punctuation($options['include-punctuation']));
$characterCollection->addChararcter(new Symbol($options['include-symbol']));

$recurrenceCollection = new RecurrenceCollection;
$recurrenceCollection->addRecurrence(new NonRepeating('non-repeating'));
$recurrenceCollection->addRecurrence(new LeastRepeating('least-repeating'));
$recurrenceCollection->addRecurrence(new MostRepeating('most-repeating'));

$errorMessaggeService = new ErrorMessageService;

$input = $options['input'];
$format = $options['format'];

$inputFlagService = new InputFlagService($characterCollection);
$formatFlagService = new FormatFlagService($recurrenceCollection);
$includeCharacterService = new IncludeCharacterService($characterCollection);
$outputService = new OutputService($characterCollection);

if (!$inputFlagService->verifyInputFlag(new InputService($input))) {
    $output = $errorMessaggeService->errorCode('Condition#1-1');
} else {

    if (!$inputFlagService->verifyFileContent(new InputService($input))) {
        $output = $errorMessaggeService->errorCode('Condition#1-2');
    } else {

        if (!$formatFlagService->verifyFormatFlag(new InputService($format))) {
            $output = $errorMessaggeService->errorCode('Condition#2');
        } else {

            if (!$includeCharacterService->verifyIncludeValue()) {
                $output = $errorMessaggeService->errorCode('Condition#3');
            } else {
                $output = $outputService->printOutput(
                    $recurrenceCollection->getRecurrence(new InputService($format)),
                    new InputService($input)
                );
            }
        }
    }
}
return $output;
