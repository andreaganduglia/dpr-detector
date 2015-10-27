<?php
session_start();
include('obj/base.php');

$app = new \Frequenze\DPR\Base;
$app->url_parse();

switch (true) {

	case $app->data['path'] == '/':
		$tpl = 'homepage';
	break;

	case $app->data['path'] == '/test':
		$tpl = 'test';
	break;

	case $app->data['path'] == '/purge':
		system('rm -f spool/*.jpg');
		die('purged');
	break;	

	case preg_match('/\/[0-9\.]{1,}x\.jpg/',$app->data['path']):
		$tpl = 'dpr_x';
	break;

	case preg_match('/^\/spool\/(.*?)_w[0-9]{1,}\.(jpg|png)$/i',$app->data['path']):
		$tpl = 'thumbs';
	break;

	default:
		$tpl = 'error404';
	break;
}

// Define the include
$filename = sprintf('tpl/%s.php',$tpl);

// Capture the output
ob_start();
if(file_exists($filename)){
	include($filename);
}else{
	include('/tpl/error404.php');
}

// Manipulate OUT
$OUT = ob_get_contents();



// Flush out;
ob_end_clean();
echo $OUT;
die();
