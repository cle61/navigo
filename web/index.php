<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider;

//
// Application setup
//

$app = new Silex\Application();
$app['debug'] = true;

// ...

//
// Controllers
//

//
// Configuration
//
require_once('config.php');

require_once('routes.php');

//return $app;
$app->run();

# php -S localhost:8080 -t ./web/