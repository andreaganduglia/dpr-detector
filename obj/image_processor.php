<?php
namespace Frequenze\DPR;

Class ImageProcessor
{

	public $imgSrc;

	public function setOutName($url)
	{
		$name = NULL;
	}

	public function makeThumb($path,$W=NULL,$H=NULL)
	{

        $image=new Imagick();
        $image->readImage($ImgSrc);

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
        $image->writeImage($path);

        /** IMAGE OUT */
        header('X-MHZ-FLY: Nice job!');
        header(sprintf('Content-type: image/%s',strtolower($image->getImageFormat())));
        echo $image->getImageBlob();
        $image->destroy();                      
        die();
	}

}