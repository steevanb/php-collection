<?php

declare(strict_types=1);

use Steevanb\ParallelProcess\{
    Console\Application\ParallelProcessesApplication,
    Process\Process,
    Process\ProcessInterfaceCollection
};
use Steevanb\PhpCollection\ScalarCollection\StringCollection;
use Symfony\Component\Console\Input\ArgvInput;

require $_SERVER['COMPOSER_HOME'] . '/vendor/autoload.php';
require dirname(__DIR__, 2) . '/vendor/autoload.php';

function createPhpstanProcesses(): ProcessInterfaceCollection
{
    $phpVersions = new StringCollection(['8.1', '8.2']);

    $return = new ProcessInterfaceCollection();
    foreach ($phpVersions->toArray() as $loopPhpVersion) {
        $return->add(createPhpstanProcess($loopPhpVersion));
    }

    return $return;
}

function createPhpstanProcess(string $phpVersion): Process
{
    return (new Process([__DIR__ . '/phpstan', '--php=' . $phpVersion]))
        ->setName('phpstan --php=' . $phpVersion);
}

(new ParallelProcessesApplication())
    ->addProcesses(createPhpstanProcesses())
    ->run(new ArgvInput($argv));
