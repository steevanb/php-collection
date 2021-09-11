<?php

declare(strict_types=1);

try {
    $xml = simplexml_load_file(__DIR__ . '/../../var/release/phpunit/coverage/xml/index.xml');
    foreach ($xml->project->directory as $directory) {
        if ((string) $directory->attributes()['name'] === '/') {
            echo ceil((float) $directory->totals->lines->attributes()['percent']);
            exit;
        }
    }
} catch (\Throwable $exception) {
    // Nothing do to
}

echo '--';
exit;
