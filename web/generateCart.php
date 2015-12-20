<?php

header("Content-type: image/png");

$cart_file = 'assets/cart.png';
$train_file = 'assets/train.png';

$imagick = new Imagick($cart_file);

$train = new Imagick($train_file);
$size  = $photo->getImageGeometry();

/*$photo->resizeImage(100, 100, imagick::FILTER_LANCZOS, 1);
$avatar = $photo->writeImage('assets/photo2.jpg');*/

// Photo
$size['width'] = 120;
$size['height'] = 120;
$x = 0;
$y = 0;

$train->cropImage($w,$h,$x,$y);

$imagick->compositeImage($train, Imagick::COMPOSITE_OVER, 30, 50);
$imagick->setImageFormat('jpg');

file_put_contents("assets/cart-transport.png", $imagick);


?>