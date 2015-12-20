<?php
$user = $app['user.manager']->createUser('test@example.com', 'MySeCrEtPaSsWoRd', 'John Doe', array('ROLE_ADMIN'));
$app['user.manager']->insert($user);