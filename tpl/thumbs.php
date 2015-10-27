<?php

// M for multiplier
$M = $app->data['dpr_x'];

// If cookie is not set, use SESSION
if(!$M){ 
	$M = $_SESSION['dpr_x'];
}

// M is valid?
if(!$M || !is_numeric($M) || $M < 2){
	$M = 1;
}

// MAX M
if($M > 4){ $M = 4; }


if(preg_match('/^\/spool\/(.*?)_w([0-9]{1,})\.(jpg|png)$/i',$app->data['path'],$matches)){

	$imgSrc = sprintf('assets/img/%s.%s',$matches[1],$matches[3]);
	$imgOut = sprintf('spool/%s_w%s_%sx.%s',$matches[1],$matches[2],$M,$matches[3]);
	$W = $matches[2];
	$H = null;

	if(!file_exists($imgSrc)){
		include('error404.php');
		return;
	}

}else{
	return;
}


// Moltiplico la dimensione
$W = $W*$M;

$image=new Imagick();
$image->readImage($imgSrc);

// Trasformo in RGB solo se e` il CMYK
if($image->getImageColorspace() == Imagick::COLORSPACE_CMYK){
        $image->transformImageColorspace(Imagick::COLORSPACE_RGB);
}
$image->profileImage('*',NULL);
$image->stripImage();

$imgWidth = $image->getImageWidth();
$imgHeight = $image->getImageHeight();

if((!$H || $H == null || $H == 0) && (!$W || $W == null || $W == 0)){
        $W = $imgWidth;
        $H = $imgHeight;
}elseif(!$H || $H == null || $H == 0){
        $H = ($W*$imgHeight)/$imgWidth;
}elseif(!$W || $W == null || $W == 0){
        $W = ($H*$imgWidth)/$imgHeight;
}                               
$image->resizeImage($W,$H,Imagick::FILTER_LANCZOS,1);
        
/** Scrivo l'immagine */
$image->writeImage($imgOut);

/** IMAGE OUT */
header(sprintf('X-MHZ-DPR: %s',$app->data['dpr_x']));
header(sprintf('Content-type: image/%s',strtolower($image->getImageFormat())));
echo $image->getImageBlob();
$image->destroy();                      
die();
