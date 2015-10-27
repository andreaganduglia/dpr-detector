<?php
namespace Frequenze\DPR;

Class Base
{
	
	public function pp($in,$format='html')
	{

		if (PHP_SAPI == 'cli') {
			$format = 'cli';
		}

		switch (strtolower($format)) {
			case 'cli':
		        print_r($in);
		        echo PHP_EOL;			
				break;

			case 'jsconsole':
				echo '<script>';
	        	echo sprintf("console.log(%s);",json_encode($in));
	        	echo '</script>';
	        	break;

	        case 'html':
			default:
				echo '<pre>';
				print_r($in);
				echo '</pre>';
				break;
		}

	}

	public function url_parse()
	{
		$URL_STRING = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$URL = (parse_url($URL_STRING));
		$URL['path'] = rtrim($URL['path'],'/');
		if(!trim($URL['path'])){ $URL['path'] = '/'; }
		$URL['part'] = explode("/",$URL['path']);
		$URL['get'] = $_GET;
		if($_COOKIE['dpr_x']){
			$URL['dpr_x'] = $_COOKIE['dpr_x'];
		}else{
			$URL['dpr_x'] = $_SESSION['dpr_x'];
		}
		$this->data = $URL;
	}

}