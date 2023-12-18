<?php

declare(strict_types=1);

use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Str;

require 'autoload.php';

$packages = array_map(fn (string $name) => 'statuses_' . $name . '_', [
    'actions',
    'attributes',
    'http_statuses',
    'lang',
]);

$path = __DIR__ . '/../algolia-indexes/';

dump([
    'path' => realpath($path),
    'files' => File::names($path)
]);

foreach (File::names($path) as $name) {
    $filename = $path . $name;

    if (! file_exists($filename)) {
        dump('File doesnt exist: ' . $filename);

        continue;
    }

    if (Str::startsWith($name, $packages)) {
        File::ensureDelete($filename);
    }
}
