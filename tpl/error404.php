<?php
header("HTTP/1.0 404 Not Found");
?><!DOCTYPE html>
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL <?=$_SERVER['REQUEST_URI']?> was not found on this server.</p>
</body></html>