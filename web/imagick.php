<?php

header("Content-type: image/jpg");

$template_file = 'assets/images/navigo-anonyme.png';
$photo_file = 'assets/images/photo.jpg';

$firstName = 'Jean';
$lastName = 'Neymar';
$id = '154684131';

function buildCard($template_file, $photo_file, $firstName, $lastName, $id)
{
	$imagick = new Imagick($template_file);

	$photo = new Imagick($photo_file);

	$draw = new ImagickDraw();

	$size  = $photo->getImageGeometry();

	$photo->resizeImage(100, 100, imagick::FILTER_LANCZOS, 1);
	$avatar = $photo->writeImage('assets/images/photo2.jpg');

	// Photo
	$w = 120;
	$h = 120;
	$x = 0;
	$y = 0;

	$photo->cropImage($w,$h,$x,$y);

 	/* Propriétées du texte */
	$draw->setFont('assets/fonts/arial.ttf');
	$draw->setFontSize( 12 );

	// FirstName
	$imagick->annotateImage($draw, 262, 180, 0, $firstName);

	// LastName
	$imagick->annotateImage($draw, 262, 200, 0, $lastName);

	// ID
	$imagick->annotateImage($draw, 262, 30, 0, $id);

	$imagick->compositeImage($photo, Imagick::COMPOSITE_OVER, 262, 50);
	$imagick->setImageFormat('jpg');

	file_put_contents("assets/images/navigo-card_".$id."jpg", $imagick);
}

buildCard($template_file, $photo_file, $firstName, $lastName, $id);


?>