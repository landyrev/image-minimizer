<?php
set_time_limit(600);
include('classSimpleImage.php');

$except = array("jpg", "png", "gif", "jpeg");
$imp = implode('|', $except);

$dir="/home/user1120552/www/testprofcoma/wp-content/uploads/";

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$arr=array();
$i=0;
foreach($objects as $name => $object){
	if(preg_match('/^.*\.('.$imp.')$/i', $name))
	{
    		$arr[$i]=$name;
		$i++;
	}
}

echo(json_encode($arr));

function downSize($filename)
{
	$imager = new SimpleImage();
	$imager->load($filename);
	
	$imager->resizeByMaxSide(1000);
	$imager->save($filename, 85);
}

?>