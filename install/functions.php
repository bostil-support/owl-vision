<?php

function oldValue(string $name, string $default = '') {
    return $_POST[$name] ?? $default;
}

function bcrypt($value)
{
    $hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => 10]);

    if ($hash === false) {
        throw new Exception('bcrypt hashing not supported');
    }

    return $hash;
}

function composerInstall(bool $withSeed = false) {
    $cd = 'cd '.__DIR__.'/..';
    $composerInstall = '/usr/bin/php composer.phar install';
    $postInstall = '/usr/bin/php composer.phar run-script post-install';
    $seed = '/usr/bin/php composer.phar run-script post-install-seed';
    $script = "$cd && $composerInstall && $postInstall" . ($withSeed ? "&& $seed" : '');

    return shell_exec($script);
}