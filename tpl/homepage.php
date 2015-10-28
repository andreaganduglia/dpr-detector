<!DOCTYPE html>
<html>
<head>
	<title>DPR DETECTOR DEMO by Andrea Ganduglia</title>
</head>
<body>
<img src="/1x.jpg" srcset="/1.0x.jpg 1x, /1.3x.jpg 1.3x, /1.5x.jpg 1.5x, /2.0x.jpg 2x, /3.0x.jpg 3x, /4.0x.jpg 4x" style="display:none"/>

<div style="text-align:center">
	<p>DPR:<?=$app->data['dpr_x']?> | Screen: <span id="screen"></span></p>
	<p><a href="/spool/image25_w640.jpg"><img src="/spool/image25_w640.jpg" width="640px" id="image_a"/></a></p>
	<p id="rel_image_a"></p>
	<p><a href="/spool/image26_w640.jpg"><img src="/spool/image26_w640.jpg" width="640px" id="image_b"/></a></p>
	<p id="rel_image_b"></p>
</div>

<a href="https://github.com/andreaganduglia/dpr-detector"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a>

<script>

function el(id){
	return document.getElementById(id);
}

var img_a = el('image_a');
img_a.onload=function(){
	var report = 'LS: '+img_a.width+'x'+img_a.height+' <=> PS: '+img_a.naturalWidth+'x'+img_a.naturalHeight;
	el('rel_image_a').innerHTML = report;
}

var img_b = el('image_b');
img_b.onload=function(){
	var report = 'LS: '+img_b.width+'x'+img_b.height+' <=> PS: '+img_b.naturalWidth+'x'+img_b.naturalHeight;
	el('rel_image_b').innerHTML = report;
}

var width = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;

var height = window.innerHeight
|| document.documentElement.clientHeight
|| document.body.clientHeight;

el('screen').innerHTML = width+'x'+height+'px';

</script>


</body>
</html>
