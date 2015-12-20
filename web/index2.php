<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Provider;
use Silex\Application;

$app = new Silex\Application();
 
$app->register(new Provider\SecurityServiceProvider());
 
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'navigo',
    'user'     => 'root',
    'password' => ' ',
);

$app['security.firewalls'] = array(
    'secured_area' => array(
        'pattern' => '^.*$',
        'anonymous' => true,
        'remember_me' => array(),
        'form' => array(
            'login_path' => '/user/login',
            'check_path' => '/user/login_check',
        ),
        'logout' => array(
            'logout_path' => '/user/logout',
        ),
        'users' => $app->share(function($app) { return $app['user.manager']; }),
    ),
);
$app['user.options'] = array(
    // ...
    'templates' => array(
        'layout' => 'layout.twig',
        'register' => 'register.twig',
        'register-confirmation-sent' => 'register-confirmation-sent.twig',
        'login' => 'login.twig',
        'login-confirmation-needed' => 'login-confirmation-needed.twig',
        'forgot-password' => 'forgot-password.twig',
        'reset-password' => 'reset-password.twig',
        'view' => 'view.twig',
        'edit' => 'edit.twig',
        'list' => 'list.twig',
    ),
);
$app['twig.path'] = array(__DIR__.'/../src/navigo/views/templates');


$simpleUserProvider = new SimpleUser\UserServiceProvider();
$app->register($simpleUserProvider);

// Mount SimpleUser routes.
$app->mount('/user', $userServiceProvider);

require_once('routes.php');
require_once('other.php');


$app->get('/', function () {

    return 'Hello world';

});


$app->run();