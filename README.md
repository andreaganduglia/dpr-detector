# HTTP DPR DETECTOR

## Synopsis

This method allow you to discover the client's DPR (Device Pixel Ratio) through HTTP, server side, without Javascript.

## Basic idea

The basic idea is test DPR with ``srcset`` attribute with an invisible image on the very first line of the ``body``:

```
<body>
<img src="/1x.jpg" srcset="/1.0x.jpg 1x, /1.3x.jpg 1.3x, /1.5x.jpg 1.5x, /2.0x.jpg 2x, /3.0x.jpg 3x, /4.0x.jpg 4x" style="display:none"/>
```

Now server side we can intercept what image the client has picked up and set a COOKIE and/or a SESSION with the consequent DRP.

```
RewriteRule ^([0-9\.]{1,})x\.jpg$ - [co=dpr_x:$1:%{HTTP_HOST}:3600:/]
```

After that, we are able to use the COOKIE/SESSION value to serve the right DPR image to the client, even create the right image on fly.

```
RewriteCond %{HTTP_COOKIE} dpr_x=([^;]+) [NC]
RewriteRule ^(.*)_w([0-9]+)\.(jpg|png)$ /$1_w$2_%1x.$3 [L,PT]
```

## Prototype code

This prototype code is written in PHP and shows how is possibile intercept the DPR since the first request (with SESSION). 
For installation just clone the repo onto your vhost root.

## Demo

[http://dpr.mhz.io/](http://dpr.mhz.io/)

## License

HTTP DRP DETECTOR is released under GPL 2 LICENSE  
Copyright (c)2015 Andrea Ganduglia [@andreaganduglia](https://twitter.com/andreaganduglia)
