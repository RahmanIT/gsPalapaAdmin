<?php
/**
 * Image resize while uploading
 * @author Resalat Haque
 * @link http://www.w3bees.com/2013/03/resize-image-while-upload-using-php.html
 */
 
/**
 * Image resize
 * @param int $width
 * @param int $height
// */

function resize($width, $height, $DataDir, $namaFoto, $type,$wabapp){
	/* Get original image x y*/
	$FotoFilesServer =  'C:/xampp/tmp/'.$namaFoto;
	list($w, $h) = getimagesize($FotoFilesServer);
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	$path =  $DataDir.'images/toponimi/'.$wabapp.'_'.$width.'x'.$height.'_'.$namaFoto;
	/* read binary data from image file */
	$imgString = file_get_contents($FotoFilesServer);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save image */
	switch ($type) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/jpg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
	return $path;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
	unlink($FotoFilesServer);
}; ?>