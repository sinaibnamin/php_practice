<?php 

// require_once __DIR__ . '/app/classes/Car.php';

spl_autoload_register( function($className){
    $baseDir = 'app/classes/';
    require_once $baseDir . $className . '.php';
});
