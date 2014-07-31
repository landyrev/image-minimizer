<?php
set_time_limit(600);
include('classSimpleImage.php');

downSize($_GET['filename']);

function downSize($filename)
{
	$imager = new SimpleImage();
	$imager->load($filename);
	
	$imager->resizeByMaxSide(1000);
	$imager->save($filename, 85);
}

?>