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
	<?php require('metatags.html') ?>
	<meta name="robots" content="index, follow" />
	
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
		<h2>Web projects</h2>
		<ul class="first">
			<li><a target="_blank" href="/mastermind">MasterMind</a></li>
			<li><a target="_blank" href="/systeminfo">SystemInfo</a></li>
			<li><a target="_blank" href="/PillowBook">PillowBook &#40;Sorry for dutch&#41;</a></li>
			<li><a target="_blank" href="/analogClock">Analog Clock</a></li>
		</ul>
		<a class="button" href="//github.com/PhiliPdB" target="_blank">View my GitHub profile</a>
	</div>
	<div class="card">
		<h2>Android projects</h2>
		<ul class="first">
			<li><a target="_blank" href="https://play.google.com/apps/testing/com.woording.android">Woording &#40;beta&#41;</a></li>
			<li><a target="_blank" href="https://play.google.com/store/apps/details?id=nl.philipdb.abcformule">Quadratic equation</a></li>
		</ul>
		<a class="button" href="https://play.google.com/store/apps/dev?id=4947359272689647365" target="_blank">View Android developer page</a>
	</div>
	<div class="card">
		<h2>Older projects</h2>
		<ul class="first">
			<li><a target="_blank" href="/pong">Pong</a></li>
			<li><a target="_blank" href="/minesweeper">MineSweeper</a></li>
			<li><a target="_blank" href="/tic-tac-toe">Tic Tac Toe</a></li>
			<li><a target="_blank" href="https://play.google.com/store/apps/details?id=nl.philipdb.snake">Snake</a></li>
		</ul>
	</div>

	<!-- Footer -->
	<?php require('components/footer.html'); ?>

	<!-- Scripts -->
	<script src="<?=version('js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>