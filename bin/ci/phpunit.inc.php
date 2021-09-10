<?php

declare(strict_types=1);

use Steevanb\ParallelProcess\{
    Process\Process,
    Process\ProcessArray
};
use steevanb\PhpTypedArray\ScalarArray\StringArray;

function createPhpunitProcesses(string $phpVersion = null, string $symfonyVersion = null): ProcessArray
{
    $phpVersions = new StringArray(is_string($phpVersion) ? [$phpVersion] : ['7.1', '7.2', '7.3', '7.4', '8.0']);
    $symfonyVersions = new StringArray(
        is_string($symfonyVersion) ? [$symfonyVersion] : ['4.4', '5.0', '5.1', '5.2', '5.3']
    );

    $return = new ProcessArray();
    foreach ($phpVersions as $loopPhpVersion) {
        foreach ($symfonyVersions as $loopSymfonyVersion) {
            if (
                (
                    in_array($loopPhpVersion, ['7.2', '7.3', '7.4', '8.0'])
                    && in_array($loopSymfonyVersion, ['4.4', '5.0', '5.1', '5.2', '5.3'])
                ) || (
                    $loopPhpVersion === '7.1'
                    && $loopSymfonyVersion === '4.4'
                )
            ) {
                $return[] = createPhpunitProcess($loopPhpVersion, $loopSymfonyVersion);
            }
        }
    }

    return $return;
}

function createPhpunitProcess(string $phpVersion, string $symfonyVersion): Process
{
    return (new Process([__DIR__ . '/phpunit', '--php=' . $phpVersion, '--symfony=' . $symfonyVersion]))
        ->setName('phpunit --php=' . $phpVersion . ' --symfony=' . $symfonyVersion);
}
