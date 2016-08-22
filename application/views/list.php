<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Pagina de prueba</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div id="container-fluid">
	<div class="col-xs-10 col-xs-offset-1">
		<h1>Pagina de prueba</h1>
		<ul>
		{personas}
			<li>Nombre: {nombre}</li>
		{/personas}
		</ul>
	</div>
</div>

</body>
</html>