<?php

declare(strict_types=1);

use Steevanb\ParallelProcess\{
    Console\Application\ParallelProcessesApplication,
    Process\Process
};
use Steevanb\PhpTypedArray\ScalarArray\StringArray;
use Symfony\Component\Console\Input\ArgvInput;

require $_SERVER['COMPOSER_HOME'] . '/vendor/autoload.php';
require dirname(__DIR__, 2) . '/vendor/autoload.php';
require __DIR__ . '/phpunit.inc.php';

$phpVersion = null;
$symfonyVersion = null;
$applicationArgv = new StringArray();
foreach ($argv as $arg) {
    if (str_starts_with($arg, '--php=')) {
        $phpVersion = substr($arg, 6);
    } elseif (str_starts_with($arg, '--symfony=')) {
        $symfonyVersion = substr($arg, 10);
    } else {
        $applicationArgv[] = $arg;
    }
}

(new ParallelProcessesApplication())
    ->addProcesses(createPhpunitProcesses($phpVersion, $symfonyVersion))
    ->run(new ArgvInput($applicationArgv->toArray()));
