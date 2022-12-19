<?php

declare(strict_types=1);

use Steevanb\ParallelProcess\{
    Process\Process,
    Process\ProcessArray
};
use Steevanb\PhpTypedArray\ScalarArray\StringArray;

function createPhpunitProcesses(string $phpVersion = null, string $symfonyVersion = null): ProcessArray
{
    $phpVersions = new StringArray(is_string($phpVersion) ? [$phpVersion] : ['8.1', '8.2']);
    $symfonyVersions = new StringArray(
        is_string($symfonyVersion) ? [$symfonyVersion] : ['6.1', '6.2']
    );

    $return = new ProcessArray();
    foreach ($phpVersions as $loopPhpVersion) {
        foreach ($symfonyVersions as $loopSymfonyVersion) {
            $return[] = createPhpunitProcess($loopPhpVersion, $loopSymfonyVersion);
        }
    }

    return $return;
}

function createPhpunitProcess(string $phpVersion, string $symfonyVersion): Process
{
    return (new Process([__DIR__ . '/phpunit', '--php=' . $phpVersion, '--symfony=' . $symfonyVersion]))
        ->setName('phpunit --php=' . $phpVersion . ' --symfony=' . $symfonyVersion);
}
