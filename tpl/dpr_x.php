<?php
// set session
preg_match_all('/([0-9\.]{1,})x\.jpg/i', $app->data['path'], $matches);
$_SESSION['dpr_x'] = $matches[1][0];

$image = new Imagick();
$image->newImage(1,1, new ImagickPixel('white'));
$image->setImageFormat('jpeg');

header('X-MHZ-DPR: '.$app->data['dpr_x']);
header('X-MHZ-DPR-SESSION: '.$_SESSION['dpr_x']);
header('Content-type: image/jpeg');;
echo $image;