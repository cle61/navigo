<?php 

// src/navigo/controller/HomeController.php
namespace navigo\Controller;

// ...
header("Content-type: image/jpg");

class HomeController extends Controller {
	private $template_file = $app['twig.path'].'/web/assets/images/photo2.jpg';

    public function generateCard($imageUrl, $firstName, $lastName, $id) {

		$imagick = new Imagick($this->template_file);

		$photo = new Imagick($imageUrl);

		$draw = new ImagickDraw();

		$size  = $photo->getImageGeometry();

		$photo->resizeImage(100, 100, imagick::FILTER_LANCZOS, 1);
		$avatar = $photo->writeImage('/web/assets/images/photo2.jpg');

		// Photo
		$w = 120;
		$h = 120;
		$x = 0;
		$y = 0;

		$photo->cropImage($w,$h,$x,$y);

	 	/* Propriétées du texte */
		$draw->setFont('/web/assets/fonts/arial.ttf');
		$draw->setFontSize( 12 );

		// FirstName
		$imagick->annotateImage($draw, 262, 180, 0, $firstName);

		// LastName
		$imagick->annotateImage($draw, 262, 200, 0, $lastName);

		// ID
		$imagick->annotateImage($draw, 262, 30, 0, $id);

		$imagick->compositeImage($photo, Imagick::COMPOSITE_OVER, 262, 50);
		$imagick->setImageFormat('jpg');

		file_put_contents("/web/assets/images/navigo-card_".$id."jpg", $imagick);

        return $this->render(
            'article/recent_list.html.twig',
            array('articles' => $articles)
        );
    }
}