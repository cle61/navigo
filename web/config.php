<?php

use Silex\Provider;

// Database config. See http://silex.sensiolabs.org/doc/providers/doctrine.html
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
$app->register(new Provider\SecurityServiceProvider());
$app->register(new Provider\DoctrineServiceProvider());
$app->register(new Provider\RememberMeServiceProvider());
$app->register(new Provider\SessionServiceProvider());
$app->register(new Provider\ServiceControllerServiceProvider());
$app->register(new Provider\UrlGeneratorServiceProvider());
$app->register(new Provider\TwigServiceProvider());
$app->register(new Provider\SwiftmailerServiceProvider());

$userServiceProvider = new SimpleUser\UserServiceProvider();
$app->register($userServiceProvider);
 
// Mount SimpleUser routes.
$app->mount('/user', $userServiceProvider);

// overide layout template
$app['twig.path'] = array(__DIR__.'/../src/navigo/views');
$app['user.options'] = array(
    'templates' => array(
        'layout'    => 'layout.twig',
        'view'      => 'profile.twig'
    ),
);