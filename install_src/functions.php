<?php

function oldValue(string $name) {
    return $_POST[$name] ?? '';
}

function bcrypt($value)
{
    $hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => 10]);

    if ($hash === false) {
        throw new Exception('bcrypt hashing not supported');
    }

    return $hash;
}

function composerInstall() {
    return shell_exec('cd '.__DIR__.'/.. && /usr/bin/php composer.phar install');
}

function configCache() {
    return shell_exec('cd '.__DIR__.'/.. && /usr/bin/php artisan config:cache');
}

function migrate() {
    return shell_exec('cd '.__DIR__.'/.. && /usr/bin/php artisan migrate');
}

function keyGenerate() {
    return shell_exec('cd '.__DIR__.'/.. && /usr/bin/php artisan key:generate');
}