<?php

require "../vendor/autoload.php";

$fat = \Base::instance();

$fat->config('../config.ini');

if (php_sapi_name() !== 'cli') {
    \controller\Start::register($fat);
    \controller\User::register($fat);
    \controller\Vote::register($fat);
    \helper\Filters::registry();
} else {
    \controller\Cli::register($fat);
}

$fat->run();
