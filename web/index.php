<?php

require "../vendor/autoload.php";

$fat = \Base::instance();

$fat->config('../config.ini');

$fat->route('GET /', function(\Base $fat){
    echo 'Hello World!';
});

$fat->run();
