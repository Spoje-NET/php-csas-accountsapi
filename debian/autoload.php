<?php
/**
 * Debian autoloader for php-spojenet-csas-accountsapi
 */

require_once '/usr/share/php/Ease/autoload.php';
require_once '/usr/share/php/GuzzleHttp/autoload.php';
require_once '/usr/share/php/Psr/Http/Message/autoload.php';

spl_autoload_register(function (string $class): void {
    $prefix = 'SpojeNet\\CSas\\';
    $baseDir = '/usr/share/php/CSasAccounts/';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }
    $file = $baseDir . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
