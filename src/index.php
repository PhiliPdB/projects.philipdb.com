<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

function version($file) {
	return $file . '?' . filemtime($file);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<?php require('metatags.html') ?>
	<meta name="robots" content="noindex, follow" />
	
	<title>Project list</title>
	
	<link rel="stylesheet" href="<?=version('css/style.css')?>">

	<!-- Favicons -->
	<?php include('favicons.html') ?>
</head>
<body>
	<!-- Google Analytics -->
	<?php include_once('analytics.html') ?>

	<!-- Header -->
	<?php require('components/header.html') ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title" class="center">
			<h1>Projects list</h1>
		</div>
	</div>

	<div class="card">
		<h2>Projects</h2>
		<ul class="first">
			<li><a href="/mastermind">MasterMind</a></li>
			<li><a href="/systeminfo">SystemInfo</a></li>
			<li><a href="/PillowBook">PillowBook &#40;Sorry for dutch&#41;</a></li>
			<li><a href="/analogClock">Analog Clock</a></li>
		</ul>
		<a class="button" href="//github.com/PhiliPdB">View my GitHub profile</a>
	</div>
	<div class="card">
		<h2>Older projects</h2>
		<ul class="first">
			<li><a href="/pong">Pong</a></li>
			<li><a href="/minesweeper">MineSweeper</a></li>
			<li><a href="/tic-tac-toe">Tic Tac Toe</a></li>
		</ul>
	</div>

	<!-- Footer -->
	<?php require('components/footer.html'); ?>

	<!-- Scripts -->
	<script src="<?=version('js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>