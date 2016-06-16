<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

function version($file) {
	return $file . '?' . filemtime($file);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="robots" content="noindex, follow" />
	
	<title>403 - Forbidden</title>
	
	<link rel="stylesheet" href="<?=version('../css/style.css')?>">

	<!-- Favicons -->
	<?php include('../favicons.html') ?>
</head>
<body>
	<!-- Header -->
	<?php require('../components/header.html'); ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title" class="center">
			<h1>Forbidden</h1>
		</div>
	</div>

	<div class="card">
		<h2>403 - Forbidden</h2>
		<p>
			You don't have the permission to access <i><?=$_SERVER[REQUEST_URI]?></i> on this server.
		</p>
		<a class="button" href="/">Go to home page</a>
	</div>

	<!-- Footer -->
	<?php require('../components/footer.html'); ?>
	
	<!-- Scripts -->
	<script src="<?=version('../js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>