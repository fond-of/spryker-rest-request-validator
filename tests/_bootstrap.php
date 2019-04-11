<?php

use org\bovigo\vfs\vfsStream;
use Spryker\Shared\Config\Environment;

$pathToAutoloader = codecept_root_dir('vendor/autoload.php');

if (!file_exists($pathToAutoloader)) {
    $pathToAutoloader = codecept_root_dir('../../autoload.php');
}

require_once $pathToAutoloader;

if (!defined('APPLICATION')) {
    define('APPLICATION', 'ZED');
}

if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', Environment::TESTING);
}

if (!defined('APPLICATION_STORE')) {
    define('APPLICATION_STORE', 'UNIT');
}

if (!defined('APPLICATION_ROOT_DIR')) {
    $x = vfsStream::setup('root');
    define('APPLICATION_ROOT_DIR', $x->url());
}

if (!defined('APPLICATION_SOURCE_DIR')) {
    $rootDir = rtrim(APPLICATION_ROOT_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    define('APPLICATION_SOURCE_DIR', $rootDir . 'src' . DIRECTORY_SEPARATOR);
}

if (!defined('APPLICATION_VENDOR_DIR')) {
    $rootDir = rtrim(APPLICATION_ROOT_DIR, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    define('APPLICATION_VENDOR_DIR', $rootDir . 'vendor' . DIRECTORY_SEPARATOR);
}
