<?php

use \Silex\Application;



// Other routes and controllers...
$app->get('/', function (Application $app) {
    return $app['twig']->render('index.twig', array(
    	'layout_template' => 'layout.twig',
    ));
});
