<?php

declare(strict_types=1);

use Steevanb\ParallelProcess\{
    Process\Process,
    Process\ProcessInterfaceCollection
};
use Steevanb\PhpCollection\ScalarCollection\StringCollection;

function createPhpunitProcesses(string $phpVersion = null, string $symfonyVersion = null): ProcessInterfaceCollection
{
    $phpVersions = new StringCollection(is_string($phpVersion) ? [$phpVersion] : ['8.1', '8.2', '8.3']);
    $symfonyVersions = new StringCollection(
        is_string($symfonyVersion) ? [$symfonyVersion] : ['6.1', '6.2', '6.3', '6.4', '7.0']
    );

    $return = new ProcessInterfaceCollection();
    foreach ($phpVersions->toArray() as $loopPhpVersion) {
        foreach ($symfonyVersions->toArray() as $loopSymfonyVersion) {
            if ($loopSymfonyVersion === '7.0' && in_array($loopPhpVersion, ['8.2', '8.3'], true) === false) {
                continue;
            }
            $return->add(createPhpunitProcess($loopPhpVersion, $loopSymfonyVersion));
        }
    }

    return $return;
}

function createPhpunitProcess(string $phpVersion, string $symfonyVersion): Process
{
    return (new Process([__DIR__ . '/phpunit', '--php=' . $phpVersion, '--symfony=' . $symfonyVersion]))
        ->setName('phpunit --php=' . $phpVersion . ' --symfony=' . $symfonyVersion);
}
